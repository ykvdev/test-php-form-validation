<?php declare(strict_types=1);

namespace libs\Forms\Validators;

class RequiredValidator extends AbstractValidator
{
    public function validate($value, array $params = []): bool
    {
        return (bool)$value;
    }
}