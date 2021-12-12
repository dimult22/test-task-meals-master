<?php

declare(strict_types=1);

namespace tests\Meals\Unit\User;

use Meals\Domain\User\Permission\Permission;
use Meals\Domain\User\Permission\PermissionList;
use Meals\Domain\User\User;
use tests\Meals\AbstractTestCase;

class UserTest extends AbstractTestCase
{
    private const ID = 2;

    public function testCreation(): void
    {
        $permissionList = new PermissionList([new Permission(Permission::VIEW_ACTIVE_POLLS)]);
        $user = new User(self::ID, $permissionList);

        self::assertEquals($user->getId(), self::ID);
        self::assertEquals($user->getPermissions(), $permissionList);
    }
}
