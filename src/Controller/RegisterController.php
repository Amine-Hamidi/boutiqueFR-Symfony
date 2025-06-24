<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index( Request $request, EntityManagerInterface $entityManager ): Response
    {
        $user= new User();
        $form=$this->createForm( UserFormTypeForm::class, $user );

        $form->handleRequest( $request ); //on ecoute la soumission du formulaire

        if( $form->isSubmitted() && $form->isValid() ){
            $entityManager->persist( $user ); //enregistrer le form
            $entityManager->flush(); //soumission form
        }
        return $this->render('register/index.html.twig',[

            'registerForm' => $form->createView()
        ]);
    }
}
