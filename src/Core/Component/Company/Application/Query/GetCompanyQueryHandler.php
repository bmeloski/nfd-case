<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Query;
use App\Core\Component\Company\Domain\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class GetCompanyQueryHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;
    private SerializerInterface $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer) {
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public function __invoke(GetCompanyQuery $query) {
        $response = $this->em->createQueryBuilder()
            ->select('company')
            ->from(Company::class, 'company')
            ->getQuery()
            ->getResult();

        var_dump($this->serializer->serialize($response, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['company', '__initializer__', '__cloner__', '__isInitialized__']]));
        die();
    }
}
