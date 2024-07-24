<?php

namespace App\Controller\Admin;

use App\Entity\Films;
use App\Entity\Genre;
use App\Entity\Acteurs;
use App\Entity\Arcom;
use App\Entity\Categories;
use App\Entity\Realisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ActeursCrudController::class)->generateUrl();
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
        yield MenuItem::linkToCrud('Genres', 'fas fa-list', Genre::class);
        yield MenuItem::linkToCrud('Films', 'fas fa-film', Films::class);
        yield MenuItem::linkToCrud('Arcom', 'fas fa-film', Arcom::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Categories::class);
    }
}
