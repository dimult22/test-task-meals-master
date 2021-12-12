<?php

declare(strict_types=1);

namespace tests\Meals\Functional\Interactor;

use Meals\Application\Component\Validator\Exception\AccessDeniedException;
use Meals\Application\Component\Validator\Exception\PollIsNotActiveException;
use Meals\Application\Feature\Poll\UseCase\EmployeeGetsActivePoll\Interactor;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Poll\Poll;
use Meals\Domain\User\Permission\Permission;
use tests\Meals\Functional\Fake\Provider\FakeEmployeeProvider;
use tests\Meals\Functional\Fake\Provider\FakePollProvider;
use tests\Meals\Functional\FunctionalTestCase;

class EmployeeGetsActivePollTest extends FunctionalTestCase
{
    public function testSuccessful()
    {
        $employee = $this->getEmployee(1, [Permission::VIEW_ACTIVE_POLLS]);
        $poll = $this->performTestMethod($employee, $this->getPoll(true));
        verify($poll)->equals($poll);
    }

    public function testUserHasNotPermissions()
    {
        $this->expectException(AccessDeniedException::class);

        $employee = $this->getEmployee();
        $poll = $this->performTestMethod($employee, $this->getPoll(true));
        verify($poll)->equals($poll);
    }

    public function testPollIsNotActive()
    {
        $this->expectException(PollIsNotActiveException::class);

        $employee = $this->getEmployee(1, [Permission::VIEW_ACTIVE_POLLS]);
        $poll = $this->performTestMethod($employee, $this->getPoll(false));
        verify($poll)->equals($poll);
    }

    private function performTestMethod(Employee $employee, Poll $poll): Poll
    {
        $this->getContainer()->get(FakeEmployeeProvider::class)->setEmployee($employee);
        $this->getContainer()->get(FakePollProvider::class)->setPoll($poll);

        return $this->getContainer()->get(Interactor::class)->getActivePoll($employee->getId(), $poll->getId());
    }
}
