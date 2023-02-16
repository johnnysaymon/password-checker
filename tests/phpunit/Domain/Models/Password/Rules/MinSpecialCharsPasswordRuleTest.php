<?php

namespace App\Tests\phpunit\Domain\Models\Password\Rules;

use App\Domain\Models\Password\Rules\MinSpecialCharsPasswordRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MinSpecialCharsPasswordRuleTest extends TestCase
{
    #[DataProvider('dataValidProvider')]
    public function testIsValid(string $password): void
    {
        $rule = new MinSpecialCharsPasswordRule(6);

        $this->assertTrue($rule->isValid($password));
    }

    #[DataProvider('dataNotValidProvider')]
    public function testNotValid(string $password): void
    {
        $rule = new MinSpecialCharsPasswordRule(6);

        $this->assertFalse($rule->isValid($password));
    }

    public static function dataValidProvider(): array
    {
        return [
            ['!@#$%^&'],
            ['&*()-+'],
            ['\/{}[]'],
            ['a!1@2#f{.)-'],
        ];
    }

    public static function dataNotValidProvider(): array
    {
        return [
            [''],
            ['1234567'],
            ['abcdefg'],
            ['ABCDEfg'],
            ['}[ab45+(h'],
            ['&*(2+'],
            ['A*3ab-+'],
        ];
    }
}
