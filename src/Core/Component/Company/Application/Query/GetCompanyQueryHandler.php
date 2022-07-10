<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\Query;

use App\Core\Component\Company\Domain\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
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
        $company =
            $this
                ->em
                ->createQueryBuilder()
                ->select('company')
                ->from(Company::class, 'company')
                ->where('company.id = :id')
                ->setParameter('id', $query->getId())
                ->getQuery()
                ->getOneOrNullResult();

        return $company;
    }
}
