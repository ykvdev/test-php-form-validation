<?php declare(strict_types=1);

namespace libs\Forms\Validators;

class EmailValidator extends AbstractValidator
{
    public function validate($value, array $params = []): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}