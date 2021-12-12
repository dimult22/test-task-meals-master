<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Poll;

use Meals\Domain\Poll\Poll;
use tests\Meals\AbstractTestCase;

class PollTest extends AbstractTestCase
{
    private const ID = 2;
    private const ACTIVE = true;

    public function testCreation(): void
    {
        $menu = $this->getMenu();
        $poll = new Poll(self::ID, self::ACTIVE, $menu);

        self::assertEquals($poll->getId(), self::ID);
        self::assertEquals($poll->isActive(), self::ACTIVE);
        self::assertEquals($poll->getMenu(), $menu);
    }
}
