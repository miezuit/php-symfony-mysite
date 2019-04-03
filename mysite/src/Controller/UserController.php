<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

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
            
        $email = $request->request->get('email');
        $password = $request->request->get('psw');
        
        $user = new User($email, $password);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($user);
        $em->flush();
        
        return new Response('Account created. '
                . 'You can login <a href="/login">here</a>');
    }
    
    /**
     * @Route("/login")
     * @param Request $request
     */
    public function login(Request $request)
    {
        if (!$request->request->has('uname') ||
            !$request->request->has('psw')) {
                return $this->render(
                        'login.html.twig',
                        ['error' => '']
                        );
            }
            
        $email = $request->request->get('uname');
        $password = $request->request->get('psw');
        
        $repo = $this->getDoctrine()->getRepository(User::class);
        
        $user = $repo->findOneBy(['email' => $email]);
        
        if(is_null($user)) {
            return $this->render(
                    'login.html.twig',
                    ['error' => 'Invalid user']
            );
        }
        
        if(!$user->hasPassword($password)) {
            return $this->render(
                    'login.html.twig',
                    ['error' => 'Invalid password']
            );
        }
        
        $request->getSession()->set('email', $email);
        $request->getSession()->set('userId', $user->getId());
        
        return $this->redirect('/tasks');
    }
    
    /**
     * @Route("/logout")
     * @param Request $request
     */
    public function logout(Request $request) {
        $request->getSession()->invalidate();
        
        return $this->redirect('/login');
    }
}
