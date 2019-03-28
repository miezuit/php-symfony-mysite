<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController {
    /**
     * @Route("/signup")
     * @param Request $request
     * @return Response
     */
    public function signUp(Request $request)
    {
        if(!$request->request->has('email')
            || !$request->request->has('psw')) {
                return $this->render('signup.html.twig');
            }
    }
}
