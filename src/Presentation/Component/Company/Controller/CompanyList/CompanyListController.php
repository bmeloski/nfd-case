<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\CompanyList;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CompanyListController extends AbstractController
{
    public function list(): Response
    {
        return new Response('Welcome to Latte and Code ');
    }
}
