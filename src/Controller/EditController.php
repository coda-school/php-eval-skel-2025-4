<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Tweet;
use App\Form\TweetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
final class EditController extends AbstractController
{
    #[Route('/tweet/{uid}/edit/', name: 'app_tweet_edit',methods:['GET','POST'])]
    public function edit(
        Tweet $tweet,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $connectedUser = $this->getUser();

        return $this->render('edit/index.html.twig', [
            'tweet' => $tweet,
            'form' => $form->createView(),
        ]);
    }
}
