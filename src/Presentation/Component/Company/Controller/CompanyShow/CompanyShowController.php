<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\CompanyShow;

use App\Core\Component\Company\Domain\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CompanyShowController extends AbstractController
{
    public function show(Company $company): Response
    {
        return new Response('Welcome to Latte and Code ');
    }
}
