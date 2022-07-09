<?php

declare(strict_types=1);

/*
 * This file is part of my Symfony boilerplate,
 * following the Explicit Architecture principles.
 *
 * @link https://herbertograca.com/2017/11/16/explicit-architecture-01-ddd-hexagonal-onion-clean-cqrs-how-i-put-it-all-together
 * @link https://herbertograca.com/2018/07/07/more-than-concentric-layers/
 *
 * (c) Herberto Graça
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Core\SharedKernel\Exception;

use Hgraca\PhpExtension\Exception\RuntimeException;

/**
 * This is the application RuntimeException, its the runtime exception that should used in our project code.
 * This is useful so we can catch and customise this projects exceptions.
 */
class AppRuntimeException extends RuntimeException
{
}
