<?php declare(strict_types=1);

namespace libs\Forms\Validators;

class PhoneValidator extends AbstractValidator
{
    public function validate($value, array $params = []): bool
    {
        return (bool)preg_match('/^\+\d{10,15}$/', $value);
    }
}