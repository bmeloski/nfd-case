<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\API\Worker;

use App\Core\Component\Company\Application\Command\Worker\UpdateWorkerCommand;
use App\Core\Component\Company\Application\DTO\Worker\WorkerDTO;
use App\Core\Component\Company\Application\DTO\Worker\WorkerDTOTransformer;
use App\Core\Component\Company\Application\Service\CompanyManagementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class WorkerUpdateController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private SerializerInterface $serializer;
    private CompanyManagementService $managementService;
    private WorkerDTOTransformer $transformer;
    private TranslatorInterface $translator;
    private ValidatorInterface $validator;

    public function __construct(
        MessageBusInterface $commandBus,
        SerializerInterface $serializer,
        CompanyManagementService $managementService,
        WorkerDTOTransformer $transformer,
        TranslatorInterface $translator,
        ValidatorInterface $validator
    )
    {
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
        $this->managementService = $managementService;
        $this->transformer = $transformer;
        $this->translator = $translator;
        $this->validator = $validator;
    }

    public function update(Request $request, int $id): Response
    {
        $response = null;

        try {
            /** @var WorkerDTO $workerDTO */
            $workerDTO = $this->serializer->deserialize($request->getContent(), WorkerDTO::class, 'json');
            $errors = $this->validator->validate($this->transformer->transferToObject($workerDTO));

            if (count($errors) > 0) {
                return new Response((string) $errors);
            }

            if (!$this->managementService->checkIfWorkerExists($id)) {
                return new Response (
                    $this->translator->trans('no_result'),
                    Response::HTTP_OK
                );
            };

            $this->commandBus->dispatch(
                new UpdateWorkerCommand(
                    $id,
                    $workerDTO->getFirstName(),
                    $workerDTO->getLastName(),
                    $workerDTO->getEmail(),
                    $workerDTO->getPhoneNumber(),
                    $workerDTO->getCompanyId()
                )
            );
            return new Response (
                $response,
                Response::HTTP_OK
            );
        } catch (\Exception $exception) {
            return new Response(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
