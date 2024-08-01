<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\ProfilFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfilController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, UserRepository $userRepository, UserInterface $user): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $userRepository->find($user->getId());

        $form = $this->createForm(ProfilFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileImage = $form->get('profilPicture')->getData();

            if ($profileImage) {
                $originalFilename = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid() . '.' . $profileImage->guessExtension();

                try {
                    $profileImage->move(
                        $this->getParameter('profil_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image.');
                    return $this->redirectToRoute('app_profil');
                }

                $user->setProfilPicture($newFilename);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Profil mis à jour avec succès!');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
    #[Route('/profil/remove-image', name: 'app_profil_remove_image', methods: ['POST'])]
    public function removeImage(Request $request, UserRepository $userRepository, UserInterface $user): RedirectResponse
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $user = $userRepository->find($user->getId());
            $user->setProfilPicture(null);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', 'Image de profil supprimée avec succès!');
        } else {
            $this->addFlash('error', 'Échec de la suppression de l\'image de profil.');
        }

        return $this->redirectToRoute('app_profil');
    }
}
