<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Container;

/**
 * Interface Registrable
 */
interface Registrable
{
    /**
     * @param string $locator
     * @param \Closure $resolver
     * @return Registrable|$this
     */
    public function register(string $locator, \Closure $resolver): self;

    /**
     * @param string $locator
     * @param object $instance
     * @return Registrable|$this
     */
    public function instance(string $locator, $instance): self;

    /**
     * @param string $locator
     * @param string ...$aliases
     * @return Registrable|$this
     */
    public function alias(string $locator, string ...$aliases): self;
}
