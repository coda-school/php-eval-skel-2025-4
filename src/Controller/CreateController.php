<?php
namespace App\Controller;

use App\Entity\Post;
use App\Form\KweekType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreateController extends AbstractController
{
    #[Route('/create', name: 'app_create', methods:['GET','POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // On vérifie que l'utilisateur est connecté
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login'); // Redirige si pas connecté
        }

        // On crée un nouveau Post vide avec ses attributs définit à 0
        $post = new Post();

        $form = $this->createForm(KweekType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            $post->setAuthor($user);
            $post->setNombreDeLikes(0);
            $post->setNombreDeVues(0);
            $post->setNombreDeCommentaires(0);

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_fil_actu');
        }

        return $this->render('create/index.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
