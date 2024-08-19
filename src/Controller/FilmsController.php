<?php

namespace App\Controller;

use App\Entity\Films;
use App\Form\FilmsType;
use App\Repository\ActeursRepository;
use App\Repository\FilmsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/films')]
class FilmsController extends AbstractController
{
    #[Route('', name: 'app_films_index', methods: ['GET'])]
    public function index(FilmsRepository $filmsRepository, ActeursRepository $acteursRepository): Response
    {
        $films = $filmsRepository->findAll();
        $acteurs = $acteursRepository->findAll();
        return $this->render('films/films.html.twig', [
            'films'=>$films,
            'acteurs'=>$acteurs
        ]);
    }

    #[Route('/{id}', name: 'app_films_show', methods: ['GET'])]
    public function show(FilmsRepository $filmsRepository, ): Response
    {
        $films = $filmsRepository->findAll();
        return $this->render('films/showFilm.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/{id}/view', name: 'app_films_view', methods: ['GET'])]
    public function view(FilmsRepository $filmsRepository): Response
    {
        $films = $filmsRepository->findAll();
        return $this->render('films/viewFilm.html.twig', [
            'films' => $films,
        ]);
    }
}
