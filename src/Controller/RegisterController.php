<?php

namespace App\Controller;

use App\Form\UserFormTypeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(UserFormTypeForm $form): Response
    {
        $form=$this->createForm(UserFormTypeForm::class);
        return $this->render('register/index.html.twig',[
            'registerForm'=>$form->createView()
        ]);
    }
}
