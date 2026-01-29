<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_profile')]
    public function profile(User $user): Response
    {
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/follow/{id}', name: 'user_follow')]
    public function follow(User $userToFollow, EntityManagerInterface $em): Response
    {
        $currentUser = $this->getUser();

        if (!$currentUser) {
            throw $this->createAccessDeniedException();
        }

        if ($currentUser !== $userToFollow) {
            $currentUser->follow($userToFollow);
            $em->flush();
        }

        return $this->redirectToRoute('user_profile', ['id' => $userToFollow->getId()]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/unfollow/{id}', name: 'user_unfollow')]
    public function unfollow(User $userToUnfollow, EntityManagerInterface $em): Response
    {
        $currentUser = $this->getUser();

        if (!$currentUser) {
            throw $this->createAccessDeniedException();
        }

        if ($currentUser !== $userToUnfollow) {
            $currentUser->unfollow($userToUnfollow);
            $em->flush();
        }

        return $this->redirectToRoute('user_profile', ['id' => $userToUnfollow->getId()]);
    }
}
