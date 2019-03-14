<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController {

    /**
     * @Route("/lucky")
     * @return Response
     */
    public function lucky()
    {
        $number = rand(1, 100);

        return new Response(
            $this->renderView('number.html.twig', ['lucky_number' => $number])
        );
    }
    
}
