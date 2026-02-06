<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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


    #[Route('/post/{id}', name: 'post_show')]
    public function show(Post $post, Request $request, EntityManagerInterface $em): Response
    {

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            if (!$user) {
                return $this->redirectToRoute('app_login');
            }


            $comment->setAuthor($user);
            $comment->setPost($post);
            $comment->setCreatedAt(new \DateTimeImmutable());

            $post->setNombreDeCommentaires($post->getNombreDeCommentaires() + 1);

            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }


        return $this->render('post/show.html.twig', [
            'post' => $post,
            'commentForm' => $form->createView(),
        ]);
    }

    // Ici c'est la route pour liker ou unliker un post
    // On récupère le post, on regarde si l'utilisateur a déjà liké,
    // et on fait l'action inverse
    #[Route('/post/{id}/like', name: 'post_like')]
    public function like(Post $post, EntityManagerInterface $em): Response{
        $user = $this->getUser();
        // blocage si l'utilisateur n'est pas connecté
        if (!$user){
            return $this->redirectToRoute('app_login');
        }
        // si l'utilisateur a déjà liké, le like disparait
        if ($post->isLikedBy($user)){
            $post -> removeLike($user);
        }
        //sinon on ajoute un like
        else{
            $post -> addLike($user);
        }
        //sauvegarde des modifications
        $em->flush();

        // Je récupère la page d'où vient le like
        $from = $_GET['from'] ?? null;

        // Si ça vient du fil d'actualité → je renvoie au fil
        if ($from === 'feed') {
            return $this->redirectToRoute('app_fil_actu');
        }

        // Si ça vient d'un profil → je renvoie au profil
        if ($from === 'profile') {
            $userId = $_GET['userId'] ?? null;
            return $this->redirectToRoute('user_profile', ['id' => $userId]);
        }

        // Sinon, par sécurité, je renvoie vers une page par défaut
        return $this->redirectToRoute('app_post');


    }
}
