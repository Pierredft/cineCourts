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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCourtMetrageController extends AbstractController
{
    #[Route('/soumettre-film', name: 'submitFilm')]
    public function soumettre(Request $request, EntityManagerInterface $em, SluggerInterface $slugger, MailerInterface $mailer, UserInterface $user): Response
    {
        $courtMetrage = new UserCourtMetrage();
        $formulaire = $this->createForm(UserCourtMetrageFormType::class, $courtMetrage);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $fichierVideo = $formulaire->get('nomFichierVideo')->getData();

            if ($fichierVideo) {
                $nomOriginal = pathinfo($fichierVideo->getClientOriginalName(), PATHINFO_FILENAME);
                $nomSecurise = $slugger->slug($nomOriginal);
                $nouveauNom = $nomSecurise . '-' . uniqid() . '.' . $fichierVideo->guessExtension();

                try {
                    $fichierVideo->move(
                        $this->getParameter('dossier_videos_user'),
                        $nouveauNom
                    );
                } catch (\Exception $e) {
                    // Gérer l'erreur si l'upload échoue
                    $this->addFlash('error', 'Erreur lors du téléchargement du fichier.');
                    return $this->render('films/submitFilm.html.twig', [
                        'formulaire' => $formulaire->createView(),
                    ]);
                }

                $courtMetrage->setNomFichierVideo($nouveauNom);
            }

            $courtMetrage->setDateCreation(new \DateTime());
            $courtMetrage->setUser($user); // Associer l'utilisateur connecté

            $em->persist($courtMetrage);
            $em->flush();

            // Envoyer un e-mail à l'administrateur
            $emailAdmin = (new Email())
                ->from('votre_adresse_email@gmail.com')
                ->to('hackathon.cinecourts@gmail.com') // Remplacez par l'adresse e-mail de l'administrateur
                ->subject('Nouvelle soumission de court métrage')
                ->html(
                    "<html>
                    <body>
                    <p>Un nouveau court métrage a été soumis.</p>
                    <p><strong>Titre :</strong> " . $courtMetrage->getTitre() . "</p>
                    <p><strong>Description :</strong> " . $courtMetrage->getDescription() . "</p>
                    <p><strong>Email :</strong> " . $courtMetrage->getEmail() . "</p>
                    <p><strong>Nom du fichier vidéo:</strong> " . $courtMetrage->getNomFichierVideo() . "</p>
                    <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                }
                                p {
                                    margin: 0 0 10px;
                                }
                                strong {
                                    color: #333;
                                }
                            </style>
                        </body>
                    </html>"
                );

            $mailer->send($emailAdmin);

            // Envoyer un e-mail de confirmation à l'utilisateur
            $emailUser = (new Email())
                ->from('CinéCourts <votre_adresse_email@gmail.com>')
                ->to($courtMetrage->getEmail()) // L'adresse e-mail de l'utilisateur soumettant le formulaire
                ->subject('Confirmation de soumission')
                ->html(
                    "<html>
                        <body>
                            <p>Merci d'avoir soumis votre court métrage.</p>
                            <p><strong>Titre :</strong> " . $courtMetrage->getTitre() . "</p>
                            <p><strong>Description :</strong> " . $courtMetrage->getDescription() . "</p>
                            <p>Nous reviendrons vers vous bientôt.</p>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    line-height: 1.6;
                                }
                                p {
                                    margin: 0 0 10px;
                                }
                                strong {
                                    color: #333;
                                }
                            </style>
                        </body>
                    </html>"
                );

            $mailer->send($emailUser);

            // Rediriger vers la page de profil
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('films/submitFilm.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }
}
