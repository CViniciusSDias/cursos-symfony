<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OlaMundoController
{
    #[Route('/ola_mundo')]
    public function index(Request $request): Response
    {
        return new Response(
            '<h1>ID:</h1>' . $request->query->get('id'),
            401,
            [
                'X-Qualquer-Coisa' => 'Valor'
            ]
        );
    }
}
