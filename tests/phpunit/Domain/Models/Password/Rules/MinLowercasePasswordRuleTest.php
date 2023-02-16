<?php

namespace App\Tests\phpunit\Domain\Models\Password\Rules;

use App\Domain\Models\Password\Rules\MinLowercasePasswordRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MinLowercasePasswordRuleTest extends TestCase
{
    #[DataProvider('dataValidProvider')]
    public function testIsValid(string $password): void
    {
        $rule = new MinLowercasePasswordRule(5);

        $this->assertTrue($rule->isValid($password));
    }

    #[DataProvider('dataNotValidProvider')]
    public function testNotValid(string $password): void
    {
        $rule = new MinLowercasePasswordRule(5);

        $this->assertFalse($rule->isValid($password));
    }

    public static function dataValidProvider(): array
    {
        return [
            ['abcde'],
            ['abcdef'],
            ['abcdEf'],
            ['a1b0cdEf'],
            ['a1b0cd*f'],
        ];
    }

    public static function dataNotValidProvider(): array
    {
        return [
            ['abcd'],
            ['ABCDE'],
            ['ABCDEF'],
            ['ABCDeF'],
            ['*****'],
            ['123abcd'],
        ];
    }
}
