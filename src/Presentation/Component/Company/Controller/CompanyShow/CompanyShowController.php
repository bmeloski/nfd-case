<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\CompanyShow;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyShowController extends AbstractController
{
    #[Route(path: '/company/{company}', name: 'company_show', methods: ['GET'])]
    public function list($company): Response
    {
        echo $company;

        return new Response('Welcome to Latte and Code ');
    }
}
