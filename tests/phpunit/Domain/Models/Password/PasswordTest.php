<?php

namespace App\Tests\phpunit\Domain\Models\Password;

use App\Domain\Models\Password\Password;
use App\Domain\Models\Password\Rules\MinDigitPasswordRule;
use App\Domain\Models\Password\Rules\MinLowercasePasswordRule;
use App\Domain\Models\Password\Rules\MinUppercasePasswordRule;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{

    public function testVerifyValidNoRules(): void
    {
        $password = new Password('123456');

        $this->assertTrue($password->verify());
    }

    public function testVerifyValidWithOneRule(): void
    {
        $password = new Password('123456');
        $password->addRule(new MinDigitPasswordRule(5));

        $this->assertTrue($password->verify());
    }

    public function testVerifyValidWithRules(): void
    {
        $password = new Password('abc1F234TX');
        $password->addRule(new MinLowercasePasswordRule(3))
            ->addRule(new MinUppercasePasswordRule(3));

        $this->assertTrue($password->verify());
    }
}
