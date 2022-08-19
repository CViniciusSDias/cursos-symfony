<?php

namespace App\Controller;

use App\Entity\Season;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpisodesController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/season/{season}/episodes', name: 'app_episodes', methods: ['GET'])]
    public function index(Season $season): Response
    {
        return $this->render('episodes/index.html.twig', [
            'season' => $season,
            'series' => $season->getSeries(),
            'episodes' => $season->getEpisodes(),
        ]);
    }

    #[Route('/season/{season}/episodes', name: 'app_watch_episodes', methods: ['POST'])]
    public function watch(Season $season, Request $request): Response
    {
        $watchedEpisodes = array_keys($request->request->all('episodes'));
        $episodes = $season->getEpisodes();

        foreach ($episodes as $episode) {
            $episode->setWatched(in_array($episode->getId(), $watchedEpisodes));
        }

        $this->entityManager->flush();

        $this->addFlash('success', 'Episódios marcados como assistidos');

        return new RedirectResponse("/season/{$season->getId()}/episodes");
    }
}
