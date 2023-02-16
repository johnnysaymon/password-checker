<?php

namespace App\Domain\Models\Password\Rules;

final readonly class MinDigitPasswordRule implements PasswordRule
{
    public const KEY = 'minDigit';

    public function __construct(
        private int $minDigit
    ) {}

    public function getKey(): string
    {
        return self::KEY;
    }

    public function isValid(string $password): bool
    {
        $total = preg_match_all('/[0-9]/', $password);
        return $total >= $this->minDigit;
    }
}