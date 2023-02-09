<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController{
    /**
     * @Route("/lucky/number", name="app_lucky_number1")
     */
    public function number(): Response{
        $number = random_int(0, 100);
        
        return new Response(
                '<html><body>Lucky number: ' .$number. '</body></html>'
        );
    }
    
    /**
     * @Route("/lucky/number2/{max}", name="app_lucky_number2")
     */
    public function number2(int $max): Response{
        $number = random_int(0, $max);
        
        return new Response(
                '<html><body>Lucky number: ' .$number. '</body></html>'
        );
    }
    
}

?>


