<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\API\Worker;

use App\Core\Component\Company\Application\Command\DeleteCompanyCommand;
use App\Core\Component\Company\Application\Command\Worker\DeleteWorkerCommand;
use App\Core\Component\Company\Application\Service\CompanyManagementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class WorkerDeleteController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private CompanyManagementService $managementService;
    private TranslatorInterface $translator;

    public function __construct(
        MessageBusInterface $commandBus,
        CompanyManagementService $managementService,
        TranslatorInterface $translator
    )
    {
        $this->commandBus = $commandBus;
        $this->managementService = $managementService;
        $this->translator = $translator;
    }

    public function delete(int $id): Response
    {
        $response = null;

        if (!$this->managementService->checkIfWorkerExists($id)) {
            return new Response (
                $this->translator->trans('no_result'),
                Response::HTTP_OK
            );
        };

        $this->commandBus->dispatch(new DeleteWorkerCommand($id));

        return new Response (
            $response,
            Response::HTTP_OK
        );
    }
}
