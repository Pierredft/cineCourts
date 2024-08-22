<?php
namespace App\Controller;

use App\Entity\UserCourtMetrage;
use App\Form\UserCourtMetrageFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserCourtMetrageController extends AbstractController
{
    #[Route('/soumettre-film', name: 'submitFilm')]
    public function soumettre(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $courtMetrage = new UserCourtMetrage();
        $formulaire = $this->createForm(UserCourtMetrageFormType::class, $courtMetrage);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $fichierVideo = $formulaire->get('nomFichierVideo')->getData();

            if ($fichierVideo) {
                $nomOriginal = pathinfo($fichierVideo->getClientOriginalName(), PATHINFO_FILENAME);
                $nomSecurise = $slugger->slug($nomOriginal);
                $nouveauNom = $nomSecurise.'-'.uniqid().'.'.$fichierVideo->guessExtension();

                try {
                    $fichierVideo->move(
                        $this->getParameter('dossier_videos_user'),
                        $nouveauNom
                    );
                } catch (\Exception $e) {
                    // Gérer l'erreur si l'upload échoue
                }

                $courtMetrage->setNomFichierVideo($nouveauNom);
            }

            $courtMetrage->setDateCreation(new \DateTime());

            $em->persist($courtMetrage);
            $em->flush();

            return $this->redirectToRoute('film_succes');
        }

        return $this->render('films/submitFilm.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }
}
