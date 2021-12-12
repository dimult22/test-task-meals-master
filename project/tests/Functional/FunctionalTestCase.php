<?php

declare(strict_types=1);

namespace tests\Meals\Functional;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use tests\Meals\AbstractTestCase;

abstract class FunctionalTestCase extends AbstractTestCase
{
    private static ContainerBuilder $container;

    public static function setContainer(ContainerBuilder $container)
    {
        self::$container = $container;
    }

    public function getContainer(): ContainerBuilder
    {
        return self::$container;
    }
}
