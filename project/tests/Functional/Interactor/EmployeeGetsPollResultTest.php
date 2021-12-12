<?php

declare(strict_types=1);

namespace tests\Meals\Functional\Interactor;

use Meals\Application\Component\Validator\Exception\AccessDeniedException;
use Meals\Application\Component\Validator\Exception\PollResultNotAllowedDateException;
use Meals\Application\Component\Validator\PollResultAllowedAtDateValidator;
use Meals\Application\Feature\PollResult\UseCase\EmployeeGetsPollResult\Interactor;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Poll\PollResult;
use Meals\Domain\User\Permission\Permission;
use Prophecy\PhpUnit\ProphecyTrait;
use tests\Meals\Functional\Fake\Provider\FakeEmployeeProvider;
use tests\Meals\Functional\Fake\Provider\FakePollResultProvider;
use tests\Meals\Functional\FunctionalTestCase;

class EmployeeGetsPollResultTest extends FunctionalTestCase
{
    use ProphecyTrait;

    public function testSuccessful(): void
    {
        $employee = $this->getEmployee(1, [Permission::VIEW_POOL_RESULT]);
        $pollResult = $this->performTestMethod($employee, $this->getPollResult(), true);

        verify($pollResult)->equals($pollResult);
    }

    public function testUserHasNotPermissions(): void
    {
        $this->expectException(AccessDeniedException::class);

        $employee = $this->getEmployee();
        $pollResult = $this->performTestMethod($employee, $this->getPollResult(), true);
        verify($pollResult)->equals($pollResult);
    }

    public function testNotAllowedDate(): void
    {
        $this->expectException(PollResultNotAllowedDateException::class);

        $employee = $this->getEmployee(1, [Permission::VIEW_POOL_RESULT]);
        $pollResult = $this->performTestMethod($employee, $this->getPollResult(), false);
        verify($pollResult)->equals($pollResult);
    }

    private function performTestMethod(Employee $employee, PollResult $pollResult, bool $validDate): PollResult
    {
        $date = $this->getPollResultDate($validDate);
        $this->getContainer()->get(FakeEmployeeProvider::class)->setEmployee($employee);
        $this->getContainer()->get(FakePollResultProvider::class)->setPollResult($pollResult);

        return $this->getContainer()->get(Interactor::class)->getPollResult($employee->getId(), $date);
    }
}
