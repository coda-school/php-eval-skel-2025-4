<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/post/{id}/like', name: 'post_like')]
    public function like(Post $post, EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Like / Unlike
        if ($post->isLikedBy($user)) {
            $post->removeLike($user);
        } else {
            $post->addLike($user);
        }

        $em->flush();

        // Récupération propre du paramètre "from"
        $from = $request->query->get('from');
        $userId = $request->query->get('userId');

        if ($from === 'feed') {
            return $this->redirectToRoute('app_fil_actu');
        }

        if ($from === 'profile' && $userId) {
            return $this->redirectToRoute('user_profile', ['id' => $userId]);
        }

        return $this->redirectToRoute('app_post');
    }
}
