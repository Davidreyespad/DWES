<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Familia;
use App\Entity\Producto;
use App\Entity\Pedido;
use App\Entity\PedidosProductos;
use App\Service\CestaCompra;

/**
 * IsGranted("ROLE_USER")
 */
class PedidosBaseController extends AbstractController {

    /**
     * @Route("/familia", name="familia")
     */
    public function obtenerFamilias(ManagerRegistry $doctrine): Response {
        $familias = $doctrine->getRepository(Familia::class)->findAll();
        return $this->render('listado_familias.html.twig', [
                    'familias' => $familias,
        ]);
    }

    /**
     * @Route("/productos{familia}", name="productos")
     */
    public function obtenerProductos(ManagerRegistry $doctrine, $familia): Response {
        $productos = $doctrine->getRepository(Familia::class)->find($familia)->getProductos();
        return $this->render('listado_productos.html.twig', [
                    'productos' => $productos,
        ]);
    }

    /**
     * @Route("/anadir/{producto_id}", name="anadir")
     */
    public function anadir(Request $request, ManagerRegistry $doctrine, $producto_id, CestaCompra $cesta): Response {

        $producto = $doctrine->getRepository(Producto::class)->find($producto_id);
        $unidades = $request->request->get('unidades');

        $cesta->anadirArticulo($unidades, $producto);
        $cesta->guardarCesta();

        return $this->redirectToRoute('cesta');
    }

    /**
     * @Route("/cesta", name="cesta")
     */
    public function mostrarCesta(CestaCompra $cesta): Response {
        $carro = $cesta->getProductos();
        $precioTotal = $cesta->precioTotal();

        //return $this->render('cesta.html.twig', $argumentos);
        return $this->render('cesta.html.twig', [
                    'carro' => $carro,
                    'precioTotal' => $precioTotal
        ]);
    }

    /**
     * @Route("/eliminar/{producto_id}", name="eliminar")
     */
    public function eliminar(Request $request, ManagerRegistry $doctrine, $producto_id, CestaCompra $cesta): Response {

        $producto = $doctrine->getRepository(Producto::class)->find($producto_id);
        $unidades = $request->request->get('unidades');

        $cesta->eliminarUnidades($unidades, $producto);
        $cesta->guardarCesta();

        return $this->redirectToRoute('cesta');
    }

    /**
     * @Route("/pedido", name="pedido")
     */
    public function hacerPedido(ManagerRegistry $doctrine, CestaCompra $cesta): Response {
        $fallo = false;
        $entityManager = $doctrine->getManager();

        $carro = $cesta->getProductos();
        $precioTotal = $cesta->precioTotal();

        $pedido = new Pedido;
        $pedido->setFecha(\DateTime::createFromFormat('Y-m-d', date("Y-m-d")));
        $pedido->setUsuario($this->getUser());
        $pedido->setCoste($precioTotal);

        $entityManager->persist($pedido);

        foreach ($carro as $producto) {
            $pedProd = new PedidosProductos ();
            $prod = $doctrine->getRepository(Producto::class)->find($producto['producto']->getId());
            $pedProd->setProducto($prod);
            $pedProd->setUnidades($producto['unidades']);
            $pedProd->setPedido($pedido);

            $entityManager->persist($pedProd);
        } try {
            $entityManager->flush();
        } catch (Exception $ex) {
            $fallo = true;
        }

        if ($fallo == true) {
            $mensaje = "Hubo un error";
            return $this->render('pedido.html.twig', array('error' => $mensaje,
                        'id_pedido' => $pedido->getId(),
                        'usuario' => $this->getUser()->getUsername(),
                        'carro' => $carro,
                        'precio' => $precioTotal));
        } else {
            $cesta->borrarCesta();
            $cesta->guardarCesta();
            $mensaje = false;
            return $this->render('pedido.html.twig', array('error' => $mensaje,
                        'id_pedido' => $pedido->getId(),
                        'usuario' => $this->getUser()->getUsername(),
                        'carro' => $carro,
                        'precio' => $precioTotal));
        }
    }

    /**
     * @Route("/pedidos", name="pedidos")
     */
    public function pedidos(ManagerRegistry $doctrine): Response {
        $pedidosProd = $doctrine->getRepository(Pedido::class)->findBy(array(
            'usuario'=>$this->getUser()));
        return $this->render('pedidos.html.twig', array(
            'pedidos' => $pedidosProd));
    }

}
