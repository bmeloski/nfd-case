<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\CompanyList;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyListController extends AbstractController
{
    #[Route(path: '/company', name: 'company_list', methods: ['GET'])]
    public function list(): Response
    {
        return new Response('Welcome to Latte and Code ');
    }
}
