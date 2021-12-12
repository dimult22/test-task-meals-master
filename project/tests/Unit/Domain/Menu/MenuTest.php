<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Menu;

use Meals\Domain\Menu\Menu;
use tests\Meals\AbstractTestCase;

class MenuTest extends AbstractTestCase
{
    private const ID = 2;
    private const TITLE = 'SomeTitle';

    public function testCreation(): void
    {
        $dishList = $this->getDishList();
        $menu = new Menu(self::ID, self::TITLE, $dishList);

        self::assertEquals($menu->getId(), self::ID);
        self::assertEquals($menu->getTitle(), self::TITLE);
        self::assertEquals($menu->getDishes(), $dishList);
    }
}
