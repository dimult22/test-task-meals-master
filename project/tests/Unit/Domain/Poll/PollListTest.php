<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Poll;

use Meals\Domain\Poll\PollList;
use tests\Meals\AbstractTestCase;

class PollListTest extends AbstractTestCase
{
    public function testCreation(): void
    {
        $polls = [$this->getPoll()];
        $pollList = new PollList($polls);

        self::assertEquals($pollList->getPolls(), $polls);
    }
}
