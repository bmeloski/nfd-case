<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\CompanyShow;

use App\Core\Component\Company\Application\DTO\CompanyDTOTransformer;
use App\Core\Component\Company\Application\Query\GetCompanyQuery;
use App\Core\Port\Messenger\QueryBus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CompanyShowController extends AbstractController
{
    private QueryBusInterface $queryBus;
    private SerializerInterface $serializer;
    private CompanyDTOTransformer $transformer;
    private TranslatorInterface $translator;

    public function __construct(
        QueryBusInterface $queryBus,
        SerializerInterface $serializer,
        CompanyDTOTransformer $transformer,
        TranslatorInterface $translator
    )
    {
        $this->queryBus = $queryBus;
        $this->serializer = $serializer;
        $this->transformer = $transformer;
        $this->translator = $translator;
    }

    public function show(int $id): Response
    {
        $companyQuery = $this->queryBus->query((new GetCompanyQuery($id)));

        $companyDTO = $companyQuery
            ? $this->transformer->transformFromObject($companyQuery)
            : [$this->translator->trans('no_result')];

        return new Response (
            $this->serializer->serialize($companyDTO, 'json'),
            Response::HTTP_OK
        );
    }
}
