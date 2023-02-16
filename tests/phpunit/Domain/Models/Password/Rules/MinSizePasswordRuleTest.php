<?php

namespace App\Tests\phpunit\Domain\Models\Password\Rules;

use App\Domain\Models\Password\Rules\MinSizePasswordRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MinSizePasswordRuleTest extends TestCase
{
    #[DataProvider('dataValidProvider')]
    public function testIsValid(string $password): void
    {
        $rule = new MinSizePasswordRule(6);

        $this->assertTrue($rule->isValid($password));
    }

    #[DataProvider('dataNotValidProvider')]
    public function testNotValid(string $password): void
    {
        $rule = new MinSizePasswordRule(6);

        $this->assertFalse($rule->isValid($password));
    }

    public static function dataValidProvider(): array
    {
        return [
            ['123456'],
            ['1234567'],
            ['abcdef'],
            ['abcdefg'],
            ['ABCDEF'],
            ['ABCDEFG'],
            ['1A2B3C4D5E6'],
            ['abc1234567'],
            ['*a(kd802a'],
        ];
    }

    public static function dataNotValidProvider(): array
    {
        return [
            ['12345'],
            ['abcde'],
            ['ABCDE'],
            ['*****'],
            ['A*3a'],
        ];
    }
}
