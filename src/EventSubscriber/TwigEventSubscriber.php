<?php
namespace App\EventSubscriber;

use App\Repository\GenresRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $genresRepository;

    public function __construct(Environment $twig, GenresRepository $genresRepository)
    {
        $this->twig = $twig;
        $this->genresRepository = $genresRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $genres = $this->genresRepository->findAll();
        $this->twig->addGlobal('genres', $genres);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}