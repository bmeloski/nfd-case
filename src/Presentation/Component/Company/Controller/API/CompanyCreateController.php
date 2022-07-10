<?php

declare(strict_types=1);

namespace App\Presentation\Component\Company\Controller\API;

use App\Core\Component\Company\Application\Command\CreateCompanyCommand;
use App\Core\Component\Company\Application\DTO\CompanyDTO;
use App\Core\Component\Company\Application\DTO\CompanyDTOTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CompanyCreateController extends AbstractController
{
    private MessageBusInterface $commandBus;
    private SerializerInterface $serializer;
    private CompanyDTOTransformer $transformer;
    private ValidatorInterface $validator;

    public function __construct(
        MessageBusInterface $commandBus,
        SerializerInterface $serializer,
        CompanyDTOTransformer $transformer,
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

        try {
            /** @var CompanyDTO $companyDTO */
            $companyDTO = $this->serializer->deserialize($request->getContent(), CompanyDTO::class, 'json');

            $errors = $this->validator->validate($this->transformer->transferToObject($companyDTO));

            if (count($errors) > 0) {
                return new Response((string) $errors);
            }

            $this->commandBus->dispatch(
                new CreateCompanyCommand(
                    $companyDTO->getName(),
                    $companyDTO->getTaxNumber(),
                    $companyDTO->getAddress()->getStreetAddress(),
                    $companyDTO->getAddress()->getCity(),
                    $companyDTO->getAddress()->getPostalCode()
                )
            );

            return new Response (
                $response,
                Response::HTTP_CREATED
            );
        } catch (\Exception $exception) {
            return new Response(
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }
}
