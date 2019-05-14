<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    
    
    /**
     * @Route("/register", name="register", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayRegister()
    {
        return $this->render('security/register.html.twig', [
            'controller_name' => 'Controller'
        ]);
    }
    
    
    /**
     * @Route("/register", name="store_register", methods={"POST"})
     * @param Request $request
     * @return void
     */
    public function storeRegister(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        if ($request->get('password') !== $request->get('confirm_password')) {
            return $this->redirectToRoute('register');
            
        }
        $user->setEmail($request->get('email'));
        $user->setName($request->get('name'));
        
        // encode the plain password
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $request->get('password')
            )
        );
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        // do anything else you need here, like send an email
        
        return $this->redirectToRoute('app_login');
    }
}
