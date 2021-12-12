<?php

declare(strict_types=1);

namespace tests\Meals\Unit\User\Permission;

use Meals\Domain\User\Permission\Permission;
use Meals\Domain\User\Permission\PermissionList;
use tests\Meals\AbstractTestCase;

class PermissionListTest extends AbstractTestCase
{
    public function testCreation(): void
    {
        $permission = new Permission(Permission::VIEW_ACTIVE_POLLS);
        $permissions = [$permission];
        $permissionList = new PermissionList($permissions);

        self::assertEquals($permissionList->getPermissions(), $permissions);
        self::assertTrue($permissionList->hasPermission($permission));
        self::assertFalse($permissionList->hasPermission(new Permission(Permission::PARTICIPATION_IN_POLLS)));
    }
}
