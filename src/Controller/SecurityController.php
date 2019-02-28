<?php

namespace App\Controller;

use App\Form\Handler\UserHandler;
use App\Form\RegisterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Description of SecurityController
 *
 * @author julien
 */
class SecurityController extends AbstractController {
    
    /**
     * @Route("/register", name="app_register", methods={"GET","POST"})
     */
    public function register(UserHandler $formHandler, Request $request, UserPasswordEncoderInterface $encoder): Response
        {
            $form = $this->createForm(RegisterType::class);
            
            if ($formHandler->handle($form, $request, $encoder)) {
                return $this->redirectToRoute('default');
            }
            return $this->render('security/register.html.twig', [
               'form' => $form->createView() 
            ]);
        }
        
     /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
        {
            return $this->render('security/login.html.twig', [
                'error' => $authenticationUtils->getLastAuthenticationError(),
                'last_username' => $authenticationUtils->getLastUsername()
            ]);
        }
        
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
        {

        }

}
