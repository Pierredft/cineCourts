<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoType;
use App\Entity\UserVideoProgress;
use App\Repository\FilmsRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserVideoProgressRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/video')]
class VideoController extends AbstractController
{
    #[Route('/', name: 'app_video_index', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(VideoRepository $videoRepository, FilmsRepository $filmsRepository): Response
    {
        $films = $filmsRepository->findAll();
        return $this->render('video/index.html.twig', [
            'videos' => $videoRepository->findAll(),
            'films' => $films
        ]);
    }

    #[Route('/new', name: 'app_video_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Upload the file
            $file = $form->get('file')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('videos_directory'),
                $fileName
            );

            // Set the file name in the video entity
            $video->setFileName($fileName);

            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video/new.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_video_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Video $video): Response
    {
        return $this->render('video/show.html.twig', [
            'video' => $video,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_video_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Video $video, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('video/edit.html.twig', [
            'video' => $video,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_video_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Video $video, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$video->getId(), $request->request->get('_token'))) {
            $entityManager->remove($video);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_video_index', [], Response::HTTP_SEE_OTHER);
    }
}