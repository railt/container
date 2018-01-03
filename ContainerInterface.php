<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Container;

use Psr\Container\ContainerInterface as PSRContainer;

/**
 * Interface ContainerInterface
 */
interface ContainerInterface extends PSRContainer, Autowireable, Registrable
{
}
