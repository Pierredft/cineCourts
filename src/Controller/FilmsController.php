<?php

namespace App\Controller;

use App\Entity\Films;
use App\Entity\Video;
use App\Form\FilmsType;
use App\Repository\FilmsRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/films')]
class FilmsController extends AbstractController
{
    #[Route('', name: 'app_films_index', methods: ['GET'])]
    public function index(FilmsRepository $filmsRepository, VideoRepository $videoRepository): Response
    {
        // $films = $filmsRepository->findAll();
        $video = $videoRepository->findAll();
        return $this->render('films/films.html.twig', [
            // 'films'=>$films,
            'videos'=>$video,
        ]);
    }

    #[Route('/{id}', name: 'app_films_show', methods: ['GET'])]
    public function show(Films $films, VideoRepository $videoRepository): Response
    {
        $video = $videoRepository->findBy(['films' => $films->getId()]);
        return $this->render('films/showFilm.html.twig', [
            'films' => $films,
            'videos' => $video,
        ]);
    }

    #[Route('/{id}/view', name: 'app_films_view', methods: ['GET'])]
    public function view(Films $films, VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy(['films' => $films->getId()]);
        return $this->render('films/viewFilm.html.twig', [
            'films' => $films,
            'videos' => $videos,
        ]);
    }


    #[Route("/films/genre/{id}", name:"films_par_genre")]
    public function filmsParGenre(int $id, FilmsRepository $filmRepository): Response
    {
        $films = $filmRepository->findByGenre($id);

        return $this->render('films/films_par_genre.html.twig', [
            'films' => $films,
        ]);
    }
}
