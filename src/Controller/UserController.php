<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'user_profile')]
    public function profile(User $user): Response
    {
        $posts = $user->getPosts();
        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'posts' => $posts,
        ]);

    }

    #[Route('/user/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('user_profile', ['id' => $user->getId()]);
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();


            return $this->redirectToRoute('user_profile', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
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
