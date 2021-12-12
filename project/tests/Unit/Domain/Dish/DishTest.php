<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Dish;

use Meals\Domain\Dish\Dish;
use tests\Meals\AbstractTestCase;

class DishTest extends AbstractTestCase
{
    private const ID = 2;
    private const TITLE = 'SomeTitle';
    private const DESCRIPTION = 'SomeDescription';

    public function testCreation(): void
    {
        $dish = new Dish(self::ID, self::TITLE, self::DESCRIPTION);

        self::assertEquals($dish->getId(), self::ID);
        self::assertEquals($dish->getTitle(), self::TITLE);
        self::assertEquals($dish->getDescription(), self::DESCRIPTION);
    }
}
