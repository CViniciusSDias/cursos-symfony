<?php

namespace App\Controller;

use App\Entity\Series;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    #[Route('/series', name: 'app_series', methods: ['GET'])]
    public function seriesList(Request $request): Response
    {
        $seriesList = $this->seriesRepository->findAll();
        $session = $request->getSession();
        $successMessage = $session->get('success');
        $session->remove('success');

        return $this->render('series/index.html.twig', [
            'seriesList' => $seriesList,
            'successMessage' => $successMessage,
        ]);
    }

    #[Route('/series/create', name: 'app_series_form', methods: ['GET'])]
    public function addSeriesForm(): Response
    {
        return $this->render('series/form.html.twig');
    }

    #[Route('/series/create', name: 'app_add_series', methods: ['POST'])]
    public function addSeries(Request $request): Response
    {
        $seriesName = $request->request->get('name');
        $series = new Series($seriesName);

        $this->seriesRepository->add($series, true);
        return new RedirectResponse('/series');
    }

    #[Route(
        '/series/delete/{id}',
        name: 'app_delete_series',
        methods: ['DELETE'],
        requirements: ['id' => '[0-9]+']
    )]
    public function deleteSeries(int $id, Request $request): Response
    {
        $this->seriesRepository->removeById($id);
        $session = $request->getSession();
        $session->set('success', 'Série removida com sucesso');

        return new RedirectResponse('/series');
    }
}
