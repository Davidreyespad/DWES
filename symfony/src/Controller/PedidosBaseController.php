<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Familia;
use App\Entity\Producto;
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

        $cesta->cargarCesta();
        $cesta->anadirArticulo($producto, $unidades);        
        $cesta->guardaCesta();
        
        return $this->redirectToRoute('cesta');
    }

    /**
     * @Route("/cesta", name="cesta")
     */
    public function mostrarCesta(CestaCompra $cesta): Response {
        $cesta->cargarCesta();       
        $precioTotal = $cesta->precioTotal();
        $argumentos = ['cesta' => $cesta->getProductos(), 'total' => $precioTotal];
        return $this->render('cesta.html.twig', $argumentos);
    }

    /**
     * @Route("/eliminar/{producto_id}", name="eliminar")
     */
    public function eliminar(Request $request, ManagerRegistry $doctrine, $producto_id, CestaCompra $cesta): Response {
                    
        $producto = $doctrine->getRepository(Producto::class)->find($producto_id);

        
        $unidades = $request->request->get('unidades');

        
        $cesta->eliminarUnidades($producto, $unidades);

        
        $cesta->guardaCesta();

        $argumentos = ['cesta' => $cesta->getProductos(), 'total' => $cesta->precioTotal()];
        return $this->render('cesta.html.twig', $argumentos);
        
        //return $this->redirectToRoute('cesta');
    }

}
