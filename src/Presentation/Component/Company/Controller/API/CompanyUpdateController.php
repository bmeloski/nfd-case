<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\API;

use App\Core\Component\Company\Application\Command\UpdateCompanyCommand;
use App\Core\Component\Company\Application\DTO\CompanyDTO;
use App\Core\Component\Company\Application\DTO\CompanyDTOTransformer;
use App\Core\Component\Company\Application\Service\CompanyManagementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CompanyUpdateController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private SerializerInterface $serializer;
    private CompanyManagementService $managementService;
    private CompanyDTOTransformer $transformer;
    private TranslatorInterface $translator;
    private ValidatorInterface $validator;

    public function __construct(
        MessageBusInterface $commandBus,
        SerializerInterface $serializer,
        CompanyManagementService $managementService,
        CompanyDTOTransformer $transformer,
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

        /** @var CompanyDTO $companyDTO */
        $companyDTO = $this->serializer->deserialize($request->getContent(), CompanyDTO::class, 'json');
        $errors = $this->validator->validate($this->transformer->transferToObject($companyDTO));

        if (count($errors) > 0) {
            return new Response((string) $errors);
        }

        if (!$this->managementService->checkIfExists($id)) {
            return new Response (
                $this->translator->trans('no_result'),
                Response::HTTP_OK
            );
        };

        $this->commandBus->dispatch(
            new UpdateCompanyCommand(
                $id,
                $companyDTO->getName(),
                $companyDTO->getTaxNumber(),
                $companyDTO->getAddress()->getStreetAddress(),
                $companyDTO->getAddress()->getCity(),
                $companyDTO->getAddress()->getPostalCode()
            )
        );
        return new Response (
            $response,
            Response::HTTP_OK
        );
    }
}
