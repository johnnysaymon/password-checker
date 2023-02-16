<?php

namespace App\Domain\Models\Password\Rules;

final readonly class MinUppercasePasswordRule implements PasswordRule
{
    public const KEY = 'minUppercase';

    public function __construct(
        private int $minLetter
    ) {}

    public function getKey(): string
    {
        return self::KEY;
    }

    public function isValid(string $password): bool
    {
        $total = preg_match_all('/[A-Z]/', $password);
        return $total >= $this->minLetter;
    }
}