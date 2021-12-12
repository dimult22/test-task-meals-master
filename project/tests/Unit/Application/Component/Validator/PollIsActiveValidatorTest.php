<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Application\Component\Validator;

use Meals\Application\Component\Validator\Exception\PollIsNotActiveException;
use Meals\Application\Component\Validator\PollIsActiveValidator;
use Meals\Domain\Poll\Poll;
use Prophecy\PhpUnit\ProphecyTrait;
use tests\Meals\AbstractTestCase;

class PollIsActiveValidatorTest extends AbstractTestCase
{
    use ProphecyTrait;

    public function testSuccessful(): void
    {
        $poll = $this->prophesize(Poll::class);
        $poll->isActive()->willReturn(true);

        $validator = new PollIsActiveValidator();
        verify($validator->validate($poll->reveal()))->null();
    }

    public function testFail(): void
    {
        $this->expectException(PollIsNotActiveException::class);

        $poll = $this->prophesize(Poll::class);
        $poll->isActive()->willReturn(false);

        $validator = new PollIsActiveValidator();
        $validator->validate($poll->reveal());
    }
}
