<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use App\Entity\Genre;
use App\Entity\Acteurs;
use App\Entity\Arcom;
use App\Entity\Categories;
use App\Entity\FilmsMovie;
use App\Entity\FilmsMovies;
use App\Entity\Genres;
use App\Entity\Realisateur;
use App\Entity\Subtitle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {   
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(FilmsCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('CineCourts');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour sur le site', 'fas fa-home', 'app_home');
        yield MenuItem::linkToCrud('Acteurs', 'fas fa-user', Acteurs::class);
        yield MenuItem::linkToCrud('Réalisateurs', 'fas fa-user', Realisateur::class);
        yield MenuItem::linkToCrud('Genres', 'fas fa-genderless', Genres::class);
        yield MenuItem::linkToCrud('Arcom', 'fas fa-ban', Arcom::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-layer-group', Categories::class);
        yield MenuItem::linkToCrud('Films', 'fas fa-film', Films::class);
        yield MenuItem::linkToCrud('Subtitle', 'fas fa-file-alt', Subtitle::class);
    }
}
