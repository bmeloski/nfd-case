<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\CompanyShow;

use App\Core\Component\Company\Application\Query\GetCompanyQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CompanyShowController extends AbstractController
{
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function show(int $id): Response
    {
        $response = $this->queryBus->dispatch(new GetCompanyQuery($id));

        var_dump($response);
        die();

        return new JsonResponse (
            $response,
            Response::HTTP_OK
        );
    }

}
