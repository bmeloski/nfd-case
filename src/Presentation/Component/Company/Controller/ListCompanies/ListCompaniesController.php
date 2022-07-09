<?php

namespace App\Presentation\Component\Company\Controller\ListCompanies;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListCompaniesController extends AbstractController
{
    #[Route(path: '/company', name: 'list_companies', methods: ['GET'])]
    public function list(): Response
    {
        return new Response('Welcome to Latte and Code ');
    }
}
