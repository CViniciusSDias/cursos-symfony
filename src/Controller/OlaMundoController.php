<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OlaMundoController
{
    #[Route('/ola_mundo', name: 'app_ola_mundo')]
    public function index(): Response
    {
        return new Response('<h1>Olá mundo</h1>' . $erro);
    }
}
