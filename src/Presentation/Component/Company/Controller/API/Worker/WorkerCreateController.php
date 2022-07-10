<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\API\Worker;

use App\Core\Component\Company\Application\Command\Worker\CreateWorkerCommand;
use App\Core\Component\Company\Application\DTO\Worker\WorkerDTO;
use App\Core\Component\Company\Application\DTO\Worker\WorkerDTOTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WorkerCreateController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private SerializerInterface $serializer;
    private WorkerDTOTransformer $transformer;
    private ValidatorInterface $validator;

    public function __construct(
        MessageBusInterface $commandBus,
        SerializerInterface $serializer,
        WorkerDTOTransformer $transformer,
        ValidatorInterface $validator
    )
    {
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
        $this->transformer = $transformer;
        $this->validator = $validator;
    }

    public function create(Request $request): Response
    {
        $response = null;

        /** @var WorkerDTO $workerDTO */
        $workerDTO = $this->serializer->deserialize($request->getContent(), WorkerDTO::class, 'json');

        $errors = $this->validator->validate($this->transformer->transferToObject($workerDTO));

        if (count($errors) > 0) {
            return new Response((string) $errors);
        }

        $this->commandBus->dispatch(
            new CreateWorkerCommand(
                $workerDTO->getFirstName(),
                $workerDTO->getLastName(),
                $workerDTO->getEmail(),
                $workerDTO->getPhoneNumber(),
                $workerDTO->getCompanyId()
            )
        );

        return new Response (
            $response,
            Response::HTTP_CREATED
        );
    }
}
