<?php

declare(strict_types=1);

namespace tests\Meals\Unit\Domain\Employee;

use Meals\Domain\Employee\Employee;
use tests\Meals\AbstractTestCase;

class EmployeeTest extends AbstractTestCase
{
    private const ID = 2;
    private const FLOOR = 3;
    private const SURNAME = 'SomeSurname';

    public function testCreation(): void
    {
        $user = $this->getUser();
        $employee = new Employee(self::ID, $user, self::FLOOR, self::SURNAME);

        self::assertEquals($employee->getId(), self::ID);
        self::assertEquals($employee->getUser(), $user);
        self::assertEquals($employee->getFloor(), self::FLOOR);
        self::assertEquals($employee->getSurname(), self::SURNAME);
    }
}
