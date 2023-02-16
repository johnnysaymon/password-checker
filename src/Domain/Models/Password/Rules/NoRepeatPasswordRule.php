<?php

namespace App\Domain\Models\Password\Rules;

final readonly class NoRepeatPasswordRule implements PasswordRule
{
    public const KEY = 'noRepeted';

    public function getKey(): string
    {
        return self::KEY;
    }

    public function isValid(string $password): bool
    {
        return preg_match('/(.)\1/', $password) === 0;
    }
}