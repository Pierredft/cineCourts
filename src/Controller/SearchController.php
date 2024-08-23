<?php
// src/Controller/SearchController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FilmsRepository;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request, FilmsRepository $filmsRepository)
    {
        $query = $request->query->get('query');
        $films = $filmsRepository->findBySearchQuery($query);

        return $this->render('search/results.html.twig', [
            'films' => $films,
        ]);
    }
}