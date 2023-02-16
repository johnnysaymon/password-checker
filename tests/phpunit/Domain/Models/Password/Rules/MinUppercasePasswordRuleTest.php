<?php

namespace App\Tests\phpunit\Domain\Models\Password\Rules;

use App\Domain\Models\Password\Rules\MinUppercasePasswordRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class MinUppercasePasswordRuleTest extends TestCase
{
    #[DataProvider('dataValidProvider')]
    public function testIsValid(string $password): void
    {
        $rule = new MinUppercasePasswordRule(5);

        $this->assertTrue($rule->isValid($password));
    }

    #[DataProvider('dataNotValidProvider')]
    public function testNotValid(string $password): void
    {
        $rule = new MinUppercasePasswordRule(5);

        $this->assertFalse($rule->isValid($password));
    }

    public static function dataValidProvider(): array
    {
        return [
            ['ABCDE'],
            ['ABCDEF'],
            ['ABCDeF'],
            ['A1B0CDeF'],
            ['A1B0CD*F'],
        ];
    }

    public static function dataNotValidProvider(): array
    {
        return [
            ['ABCD'],
            ['abcde'],
            ['abcdef'],
            ['abcdEf'],
            ['*****'],
            ['123ABCD'],
        ];
    }
}
