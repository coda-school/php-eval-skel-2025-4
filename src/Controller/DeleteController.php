<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteController extends AbstractController
{
    #[Route('/tweet/{id}/delete', name: 'app_tweet_delete', methods: ['POST'])]
    public function delete(
        Post $post,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // 1. Sécurité : Vérifier le Token CSRF (pour éviter les failles)
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {

            // 2. Vérifier que c'est bien l'auteur (Optionnel mais recommandé)
            if ($post->getAuthor() === $this->getUser()) { // ou $post->getUser() selon votre entité
                $entityManager->remove($post);
                $entityManager->flush();

                $this->addFlash('success', 'Kweek supprimé avec succès !');
            }
        }

        // 3. Redirection vers le profil
        // Assurez-vous d'utiliser $this->getUser() ici aussi
        return $this->redirectToRoute('user_profile', ['id' => $this->getUser()->getId()]);
    }
}
