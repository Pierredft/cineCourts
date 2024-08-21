<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\FilmsRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    //////////// ACCUEIL //////////////////////////////////////////////
    #[Route('', name: 'app_home')]
    public function index(FilmsRepository $filmsRepository, VideoRepository $videoRepository): Response
    {
        $films = $filmsRepository->findAll();
        $videos = $videoRepository->findAll();
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
            'films' => $films,
            'videos' => $videos
        ]);
    }

}