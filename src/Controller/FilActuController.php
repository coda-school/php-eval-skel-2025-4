<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PostRepository;

final class FilActuController extends AbstractController
{
    #[Route('/fil/actu', name: 'app_fil_actu')]
    public function index(PostRepository $postRepository): Response
    {
        $user = $this->getUser();

        if ($user) {
            $posts = $postRepository->findFeedForUser($user);

            if (empty($posts)) {
                $posts = $postRepository->findBy([], ['id' => 'DESC'], 20);
            }
        } else {
            $posts = $postRepository->findBy([], ['id' => 'DESC'], 20);
        }

        return $this->render('fil_actu/index.html.twig', [
            'posts' => $posts,
        ]);
    }

}
