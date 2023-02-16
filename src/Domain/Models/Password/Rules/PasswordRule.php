<?php

namespace App\Domain\Models\Password\Rules;

interface PasswordRule
{
    public function getKey(): string;

    public function isValid(string $password): bool;
}