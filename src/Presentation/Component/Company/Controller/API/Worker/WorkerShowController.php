<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\API\Worker;

use App\Core\Component\Company\Application\DTO\Worker\WorkerDTOTransformer;
use App\Core\Component\Company\Application\Query\Worker\GetWorkerQuery;
use App\Core\Port\Messenger\QueryBus\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class WorkerShowController extends AbstractController
{
    private QueryBusInterface $queryBus;
    private SerializerInterface $serializer;
    private WorkerDTOTransformer $transformer;
    private TranslatorInterface $translator;

    public function __construct(
        QueryBusInterface $queryBus,
        SerializerInterface $serializer,
        WorkerDTOTransformer $transformer,
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
        $workerQuery = $this->queryBus->query((new GetWorkerQuery($id)));

        $workerDTO = $workerQuery
            ? $this->transformer->transformFromObject($workerQuery)
            : [$this->translator->trans('no_result')];

        return new Response (
            $this->serializer->serialize($workerDTO, 'json'),
            Response::HTTP_OK
        );
    }
}
