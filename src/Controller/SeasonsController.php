<?php

namespace App\Controller;

use App\Entity\Series;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeasonsController extends AbstractController
{
    #[Route('/series/{series}/seasons', name: 'app_seasons')]
    public function index(Series $series): Response
    {
        $seasons = $series->getSeasons();

        return $this->render('seasons/index.html.twig', [
            'series' => $series,
            'seasons' => $seasons,
        ]);
    }
}
