<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class HomeController extends AbstractController
{
    //////////// ACCUEIL //////////////////////////////////////////////
    #[Route('', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}