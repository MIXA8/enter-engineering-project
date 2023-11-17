<?php

namespace App\Enums;

enum UserRoleEnum
{
    const STUDENT = 'student';
    const TEACHER = 'teacher';
    const DIRECTOR = 'directory';


    public static function from($value)
    {
        switch ($value) {
            case self::STUDENT:
                return 'student';
            case self::TEACHER:
                return 'teacher';
            case self::DIRECTOR:
                return 'directory';
            default:
                return null;
        }
    }

    public static function toValue($label)
    {
        switch ($label) {
            case self::STUDENT:
                return 'student';
            case self::TEACHER:
                return 'teacher';
            case self::DIRECTOR:
                return 'directory';
            default:
                return null;
        }
    }
    public static function all()
    {
        return [
            self::STUDENT,
            self::DIRECTOR,
            self::TEACHER,
        ];
    }
}
