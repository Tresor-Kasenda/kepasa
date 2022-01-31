<?php

namespace App\Enums;

class MyClass
{
    const DEFAULT = 'default';
    const SOCIAL = 'social';
    const WHATEVER = 'whatever';

    public static array $types = [
        self::DEFAULT,
        self::SOCIAL,
        self::WHATEVER
    ];
}
