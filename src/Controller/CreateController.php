<?php

namespace App\Controller;

use App\Form\KweekType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class CreateController extends AbstractController
{
    #[Route('/create', name: 'app_create', methods:['GET','POST'])]
    public function index(Request $request): Response
    {
        $form=$this->createForm(KweekType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data=$form->getData();
            $kweek=$data['kweek'];

            return $this->render('create.html.twig', [
                'kweek' => $kweek
            ]);
        }else{
            return $this->render('create/index.html.twig', [
                'controller_name' => 'CreateController',
                'formulaire' => $form
            ]);
        }




    }
}
