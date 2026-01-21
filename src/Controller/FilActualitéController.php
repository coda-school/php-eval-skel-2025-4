<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PostRepository;

final class FilActualitéController extends AbstractController
{
    #[Route('/fil/actualit/', name: 'app_fil_actualit_')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('fil_actualité/index.html.twig', [
            'controller_name' => 'FilActualitéController',
            'posts' => $posts,
        ]);
    }
}
