<?php
namespace App\Controller;

use App\Entity\Post;
use App\Form\KweekType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// ... (imports)

final class CreateController extends AbstractController
{
    #[Route('/create', name: 'app_create', methods:['GET','POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $post = new Post();
        $form = $this->createForm(KweekType::class, $post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           /** @var UploadedFile $file */
            $file = $form->get('thumbnailFile')->getData();

            // CORRECTION 1 : On utilise uniqid() car l'ID du post n'existe pas encore
            // On vérifie aussi si un fichier a bien été envoyé
            if ($file) {
                $fileName = uniqid() . '.' . $file->guessExtension();

                // CORRECTION 2 : Correction de la variable $fileName (N majuscule)
                $file->move(
                    $this->getParameter('kernel.project_dir') . '/public/images/kweek',
                    $fileName
                );

                $post->setThumbnail($fileName);
            }


            // CORRECTION 3 : J'ai retiré le dd() pour que la sauvegarde se fasse

            $post->setAuthor($user);
            // Si tu as mis des valeurs par défaut dans ton entité (ex: $nombreDeLikes = 0),
            // ces lignes sont inutiles, sinon garde-les.
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
