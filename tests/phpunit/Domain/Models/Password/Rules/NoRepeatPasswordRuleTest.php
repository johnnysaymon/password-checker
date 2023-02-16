<?php

namespace App\Tests\phpunit\Domain\Models\Password\Rules;

use App\Domain\Models\Password\Rules\NoRepeatPasswordRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class NoRepeatPasswordRuleTest extends TestCase
{
    #[DataProvider('dataValidProvider')]
    public function testIsValid(string $password): void
    {
        $rule = new NoRepeatPasswordRule();

        $this->assertTrue($rule->isValid($password));
    }

    #[DataProvider('dataNotValidProvider')]
    public function testNotValid(string $password): void
    {
        $rule = new NoRepeatPasswordRule();

        $this->assertFalse($rule->isValid($password));
    }

    public static function dataValidProvider(): array
    {
        return [
            ['abcde'],
            ['12345'],
            ['-_/()'],
            ['a*3G+'],
            ['a*3Ga'],
            ['b2b2b2'],
            [''],
        ];
    }

    public static function dataNotValidProvider(): array
    {
        return [
            ['aabcd'],
            ['01123'],
            ['a**12'],
            ['aa22**'],
            ['(('],
        ];
    }
}
