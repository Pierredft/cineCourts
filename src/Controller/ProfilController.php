<?php

namespace App\Controller;

use App\Entity\UserCourtMetrage;
use App\Form\ProfilFormType;
use App\Repository\UserRepository;
use App\Repository\UserCourtMetrageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilController extends AbstractController
{
    private $entityManager;
    private $userCourtMetrageRepository;

    public function __construct(EntityManagerInterface $entityManager, UserCourtMetrageRepository $userCourtMetrageRepository)
    {
        $this->entityManager = $entityManager;
        $this->userCourtMetrageRepository = $userCourtMetrageRepository;
    }

    #[Route('/profil', name: 'app_profil')]
    public function index(Request $request, UserRepository $userRepository, UserInterface $user): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $userRepository->find($user->getId());

        // Récupérer les courts-métrages associés à l'utilisateur
        $userCourtMetrages = $user->getUserCourtMetrages();

        // Créer le formulaire
        $form = $this->createForm(ProfilFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileImage = $form->get('profilPicture')->getData();

            if ($profileImage) {
                $originalFilename = pathinfo($profileImage->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = uniqid() . '.' . $profileImage->guessExtension();

                try {
                    $profileImage->move(
                        $this->getParameter('profile_images_directory'),
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
            'userCourtMetrages' => $userCourtMetrages,
        ]);
    }

    #[Route('/profil/remove-image', name: 'app_profil_remove_image')]
    public function removeImage(UserInterface $user, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($user->getId());
        $user->setProfilPicture(null);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->addFlash('success', 'Image de profil supprimée avec succès!');

        return $this->redirectToRoute('app_profil');
    }
}
