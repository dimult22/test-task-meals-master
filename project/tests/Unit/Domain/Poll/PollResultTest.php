<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Poll;

use Meals\Domain\Poll\PollResult;
use tests\Meals\AbstractTestCase;

class PollResultTest extends AbstractTestCase
{
    private const ID = 2;

    public function testCreation(): void
    {
        $poll = $this->getPoll();
        $employee = $this->getEmployee();
        $dish = $this->getDish();
        $pollResult = new PollResult(self::ID, $poll, $employee, $dish);

        self::assertEquals($pollResult->getId(), self::ID);
        self::assertEquals($pollResult->getPoll(), $poll);
        self::assertEquals($pollResult->getEmployee(), $employee);
        self::assertEquals($pollResult->getDish(), $dish);
        self::assertEquals($pollResult->getEmployeeFloor(), $employee->getFloor());
    }
}
