<?php
/**
 * This file is part of Railgun package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Serafim\Railgun\Http;

/**
 * Interface RequestInterface
 * @package Serafim\Railgun\Http
 */
interface RequestInterface
{
    /**
     * Query http (GET/POST) argument name passed by default
     */
    public const DEFAULT_QUERY_ARGUMENT = 'query';

    /**
     * Variables http (GET/POST) argument name passed by default
     */
    public const DEFAULT_VARIABLES_ARGUMENT = 'variables';

    /**
     * Operation http (GET/POST) argument name passed by default
     */
    public const DEFAULT_OPERATION_ARGUMENT = 'operation';

    /**
     * @return string
     */
    public function getQuery(): string;

    /**
     * @return null|string
     */
    public function getVariables(): ?string;

    /**
     * @return null|string
     */
    public function getOperation(): ?string;
}
