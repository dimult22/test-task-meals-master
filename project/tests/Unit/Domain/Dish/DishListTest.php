<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Dish;

use Meals\Domain\Dish\DishList;
use tests\Meals\AbstractTestCase;

class DishListTest extends AbstractTestCase
{
    public function testCreation(): void
    {
        $dish = $this->getDish();
        $dishList = new DishList([$dish]);

        self::assertCount(1, $dishList->getDishes());
        self::assertTrue($dishList->hasDish($dish));
        self::assertFalse($dishList->hasDish($this->getDish()));
    }
}
