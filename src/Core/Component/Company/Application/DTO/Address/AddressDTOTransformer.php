<?php

declare(strict_types=1);

namespace App\Core\Component\Company\Application\DTO\Address;

use App\Core\Infrastructure\Response\DTO\Transformer\AbstractResponseDTOTransformer;

class AddressDTOTransformer extends AbstractResponseDTOTransformer
{
    public function transformFromObject($address): AddressDTO
    {
        return new AddressDTO(
            $address->getId(),
            $address->getStreetAddress(),
            $address->getCity(),
            $address->getPostalCode()
        );
    }

}
