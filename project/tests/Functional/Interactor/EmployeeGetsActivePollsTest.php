<?php

declare(strict_types=1);

namespace tests\Meals\Functional\Interactor;

use Meals\Application\Component\Validator\Exception\AccessDeniedException;
use Meals\Application\Feature\Poll\UseCase\EmployeeGetsActivePolls\Interactor;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Poll\PollList;
use Meals\Domain\User\Permission\Permission;
use tests\Meals\Functional\Fake\Provider\FakeEmployeeProvider;
use tests\Meals\Functional\Fake\Provider\FakePollProvider;
use tests\Meals\Functional\FunctionalTestCase;

class EmployeeGetsActivePollsTest extends FunctionalTestCase
{
    public function testSuccessful(): void
    {
        $employee = $this->getEmployee(1, [Permission::VIEW_ACTIVE_POLLS]);
        $poll = $this->performTestMethod($employee, $this->getPollList());
        verify($poll)->equals($poll);
    }

    public function testUserHasNotPermissions(): void
    {
        $this->expectException(AccessDeniedException::class);

        $employee = $this->getEmployee();
        $poll = $this->performTestMethod($employee, $this->getPollList());
        verify($poll)->equals($poll);
    }

    private function performTestMethod(Employee $employee, PollList $pollList): PollList
    {
        $this->getContainer()->get(FakeEmployeeProvider::class)->setEmployee($employee);
        $this->getContainer()->get(FakePollProvider::class)->setPolls($pollList);

        return $this->getContainer()->get(Interactor::class)->getActivePolls($employee->getId());
    }
}
