<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */

class PedidosBaseController extends AbstractController
{
    /**
     * @Route("/Familia", name="Familia")
     */
    public function obtenerFamilias(ManagerRegistry $doctrine): Response
    {
        $familias = $doctrine-> getRepository(Familia::class)->findAll();
        return $this->render('pedidos_base/familias.html.twig', [
            'familias' => $familias,
        ]);
    }
}
