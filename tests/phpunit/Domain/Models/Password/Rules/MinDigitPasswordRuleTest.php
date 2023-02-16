<?php

namespace App\Tests\phpunit\Domain\Models\Password\Rules;

use App\Domain\Models\Password\Rules\MinDigitPasswordRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MinDigitPasswordRuleTest extends TestCase
{
    #[DataProvider('dataValidProvider')]
    public function testIsValid(string $password): void
    {
        $rule = new MinDigitPasswordRule(6);

        $this->assertTrue($rule->isValid($password));
    }

    #[DataProvider('dataNotValidProvider')]
    public function testNotValid(string $password): void
    {
        $rule = new MinDigitPasswordRule(6);

        $this->assertFalse($rule->isValid($password));
    }

    public static function dataValidProvider(): array
    {
        return [
            ['012345'],
            ['123456'],
            ['1234567'],
            ['1A2B3C4D5E6'],
            ['abc1234567'],
        ];
    }

    public static function dataNotValidProvider(): array
    {
        return [
            ['12345'],
            ['abcdef'],
            ['ABCDE'],
            ['*****'],
            ['ABC123D'],
        ];
    }
}
