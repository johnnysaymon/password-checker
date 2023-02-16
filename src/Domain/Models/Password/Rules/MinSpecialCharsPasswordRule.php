<?php

namespace App\Domain\Models\Password\Rules;

final readonly class MinSpecialCharsPasswordRule implements PasswordRule
{
    public const KEY = 'minSpecialChars';

    public function __construct(
        private int $minSpecialChars
    ) {}

    public function getKey(): string
    {
        return self::KEY;
    }

    public function isValid(string $password): bool
    {
        $total = preg_match_all('/[!@#$%^&*()\-+\/{}\[\]\\\]/', $password);
        return $total >= $this->minSpecialChars;
    }
}