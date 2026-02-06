<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;


final class FilActuController extends AbstractController
{
    #[Route('/fil/actu', name: 'app_fil_actu')]
    public function index(PostRepository $postRepository, Request $request): Response
    {
        $tab = $request->query->get('tab', 'feed');
        $search = $request->query->get('search');

        $page = (int)$request->query->get('page', 1);

        if ($search) {
            $posts = $postRepository->searchByKeyword($search);
        } elseif ($tab === 'trending') {
            $posts = $postRepository->findTopTrending(50);
        } else {
            $user = $this->getUser();
            if ($user) {
                $posts = $postRepository->findFeedForUser($user);
                if (empty($posts)) {
                    $posts = $postRepository->findBy([], ['id' => 'DESC'], 20);
                }
            } else {
                $posts = $postRepository->findBy([], ['id' => 'DESC'], 20);
            }
        }

        return $this->render('fil_actu/index.html.twig', [
            'posts' => $posts,
            'tab' => $tab,
            'searchTerm' => $search,
            'currentPage' => $page
        ]);
    }
}
