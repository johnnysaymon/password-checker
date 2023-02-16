<?php

namespace App\Domain\Models\Password;

use App\Domain\Models\Password\Rules\MinDigitPasswordRule;
use App\Domain\Models\Password\Rules\MinLowercasePasswordRule;
use App\Domain\Models\Password\Rules\MinSizePasswordRule;
use App\Domain\Models\Password\Rules\MinSpecialCharsPasswordRule;
use App\Domain\Models\Password\Rules\MinUppercasePasswordRule;
use App\Domain\Models\Password\Rules\NoRepeatPasswordRule;

final class PasswordFactory
{
    public static function create(string $password, array $rulesList): Password
    {
        $passwordModel = new Password($password);

        foreach ($rulesList as $ruleItem) {
            $rule = match ($ruleItem['rule'] ?? null) {
                MinSizePasswordRule::KEY => new MinSizePasswordRule($ruleItem['value'] ?? 0),
                MinUppercasePasswordRule::KEY => new MinUppercasePasswordRule($ruleItem['value'] ?? 0),
                MinLowercasePasswordRule::KEY => new MinLowercasePasswordRule($ruleItem['value'] ?? 0),
                MinDigitPasswordRule::KEY => new MinDigitPasswordRule($ruleItem['value'] ?? 0),
                MinSpecialCharsPasswordRule::KEY => new MinSpecialCharsPasswordRule($ruleItem['value'] ?? 0),
                NoRepeatPasswordRule::KEY => new NoRepeatPasswordRule(),
                default => null
            };
            $rule && $passwordModel->addRule($rule);
        }

        return $passwordModel;
    }
}