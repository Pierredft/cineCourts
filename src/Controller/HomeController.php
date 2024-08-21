<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\FilmsRepository;
use App\Repository\GenreRepository;
use App\Repository\VideoRepository;
use App\Repository\GenresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HomeController extends AbstractController
{
    //////////// ACCUEIL //////////////////////////////////////////////
    #[Route('', name: 'app_home')]
    public function index(FilmsRepository $filmsRepository, VideoRepository $videoRepository, GenresRepository $genresRepository, Request $request): Response
    {
        $selectedGenreId = $request->query->get('genre');
        $films = $filmsRepository->findAll();
        $videos = $videoRepository->findAll();
        $genres = $genresRepository->findAll();

        if ($selectedGenreId) {
            $filmsGenre = $filmsRepository->findByGenreId($selectedGenreId);
        } else {
            $filmsGenre = $filmsRepository->findAll();
        }
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'films' => $films,
            'videos' => $videos,
            'genres' => $genres,
            'selectedGenre' => $selectedGenreId,
            'filmsGenre' => $filmsGenre,
        ]);
    }

}