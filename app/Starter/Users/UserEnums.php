<?php

namespace App\Starter\Users;

abstract class UserEnums
{
    /**
     * List of all user's type used in users table
     */
    public const ADMIN_TYPE = 'admin',
        SUPER_ADMIN_TYPE = 'super_admin';

    public static function userTypes()
    {
        return [
            self::ADMIN_TYPE => self::ADMIN_TYPE,
            self::SUPER_ADMIN_TYPE => self::SUPER_ADMIN_TYPE
        ];
    }
}
