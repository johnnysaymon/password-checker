<?php

namespace App\Domain\Models\Password\Rules;

final readonly class MinLowercasePasswordRule implements PasswordRule
{
    public const KEY = 'minLowercase';

    public function __construct(
        private int $minLetter
    ) {}

    public function getKey(): string
    {
        return self::KEY;
    }

    public function isValid(string $password): bool
    {
        $total = preg_match_all('/[a-z]/', $password);
        return $total >= $this->minLetter;
    }
}