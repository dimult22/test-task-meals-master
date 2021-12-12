<?php

declare(strict_types=1);

namespace tests\Meals;

use Meals\Domain\Dish\DishList;
use Meals\Domain\Employee\Employee;
use Meals\Domain\Menu\Menu;
use Meals\Domain\Poll\Poll;
use Meals\Domain\Poll\PollList;
use Meals\Domain\User\Permission\Permission;
use Meals\Domain\User\Permission\PermissionList;
use Meals\Domain\User\User;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    protected function getEmployee(int $floor = 1, array $userPermissions = []): Employee
    {
        return new Employee(
            rand(),
            $this->getUser($userPermissions),
            $floor,
            'Surname'
        );
    }

    protected function getUser(array $userPermissions = []): User
    {
        $permissions = [];
        foreach ($userPermissions as $userPermission) {
            $permissions[] = new Permission($userPermission);
         }

        return new User(
            rand(),
            new PermissionList($permissions),
        );
    }

    protected function getPoll(bool $active = true, string $title = 'title'): Poll
    {
        return new Poll(
            rand(),
            $active,
            new Menu(
                rand(),
                $title,
                new DishList([]),
            )
        );
    }

    protected function getPollList(): PollList
    {
        return new PollList([$this->getPoll()]);
    }
}
