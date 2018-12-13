<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\Container;

use Illuminate\Container\Container as IlluminateContainer;
use Railt\Container\Container;
use Railt\Container\Exception\ContainerResolutionException;
use Symfony\Component\DependencyInjection\Container as SymfonyContainer;

/**
 * Class ProxyResolvingTestCase
 */
class ProxyResolvingTestCase extends TestCase
{
    /**
     * @return array
     * @throws \Symfony\Component\DependencyInjection\Exception\InvalidArgumentException
     */
    public function containerDataProvider(): array
    {
        // Prepare Symfony DI Container
        $symfony = new SymfonyContainer();
        $symfony->set('locator', new \stdClass());
        $symfony->set(\stdClass::class, new \stdClass());

        // Prepare Laravel DI Container
        $laravel = new IlluminateContainer();
        $laravel->instance('locator', new \stdClass());
        $laravel->instance(\stdClass::class, new \stdClass());

        // Prepare Self DI Container
        $railt = new Container();
        $railt->instance('locator', new \stdClass());
        $railt->instance(\stdClass::class, new \stdClass());

        // Providers
        return [
            'Symfony' => [new Container($symfony)],
            'Laravel' => [new Container($laravel)],
            'Railt'   => [new Container($railt)],
        ];
    }

    /**
     * @dataProvider containerDataProvider
     * @param Container $container
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \ReflectionException
     */
    public function testSelectionByLocatorThroughProxy(Container $container): void
    {
        $this->assertInstanceOf(\stdClass::class, $container->get('locator'));
    }

    /**
     * @dataProvider containerDataProvider
     * @param Container $container
     * @throws \PHPUnit\Framework\Exception
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \ReflectionException
     */
    public function testSelectionByClassThroughProxy(Container $container): void
    {
        $this->assertInstanceOf(\stdClass::class, $container->get(\stdClass::class));
    }

    /**
     * @dataProvider containerDataProvider
     * @param Container $container
     * @throws \PHPUnit\Framework\Exception
     * @throws \ReflectionException
     */
    public function testServiceNotAllowed(Container $container): void
    {
        $this->expectException(ContainerResolutionException::class);
        $this->expectExceptionMessage('"whoops" entry is not registered');

        $container->get('whoops');
    }

    /**
     * @dataProvider containerDataProvider
     * @param Container $container
     * @throws \PHPUnit\Framework\Exception
     * @throws \ReflectionException
     */
    public function testServiceOverriding(Container $container): void
    {
        try {
            $hasError = false;
            $container->get('test');
        } catch (ContainerResolutionException $e) {
            $hasError = true;
        }

        $this->assertTrue($hasError);

        $container->instance('test', new \stdClass());
        $this->assertInstanceOf(\stdClass::class, $container->get('test'));
    }
}
