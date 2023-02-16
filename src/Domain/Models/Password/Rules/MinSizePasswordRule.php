<?php

namespace App\Domain\Models\Password\Rules;

final readonly class MinSizePasswordRule implements PasswordRule
{
    public const KEY = 'minSize';

    public function __construct(
        private int $minSize
    ){}

    public function isValid(string $password): bool
    {
        return strlen($password) >= $this->minSize;
    }

    public function getKey(): string
    {
        return self::KEY;
    }
}