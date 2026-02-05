<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Post; // <--- CORRECTION ICI (au lieu de Tweet)
use App\Form\KweekType; // Vérifiez aussi si le formulaire s'appelle TweetType ou PostType
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class EditController extends AbstractController
{
    // J'ai remplacé {uid} par {id} pour faciliter la reconnaissance automatique par Symfony
    #[Route('/tweet/{id}/edit/', name: 'app_tweet_edit', methods:['GET','POST'])]
    public function edit(
        Post $post, // <--- CORRECTION ICI : On injecte l'entité Post
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {

        // Vérification optionnelle du propriétaire (sécurité)
        // if ($post->getUser() !== $this->getUser()) { ... }

        $form = $this->createForm(KweekType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirection vers le profil
            return $this->redirectToRoute('user_profile', ['id' => $this->getUser()->getId()]);
        }

        return $this->render('edit/index.html.twig', [
            'tweet' => $post, // On passe la variable à la vue
            'form' => $form->createView(),
        ]);
    }
}
