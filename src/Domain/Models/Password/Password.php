<?php

declare(strict_types=1);

namespace App\Domain\Models\Password;

use App\Domain\Models\Password\Rules\PasswordRule;

final class Password
{
    /** @var PasswordRule[] */
    private array $rules;
    /** @var string[] */
    private array $erros;

    public function __construct(
        private readonly string $password
    ){
        $this->erros = [];
        $this->rules = [];
    }

    public function verify(): bool
    {
        foreach ($this->rules as $rule) {
            if($rule->isValid($this->password) === false){
                $this->erros[] = $rule->getKey();
            }
        }

        return empty($this->erros);
    }

    public function addRule(PasswordRule $rule): self
    {
        $this->rules[] = $rule;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getErros(): array
    {
        return $this->erros;
    }
}