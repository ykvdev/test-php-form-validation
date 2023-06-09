<?php declare(strict_types=1);

namespace libs\Validators;

class RequiredValidator extends AbstractValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, array $params = []): bool
    {
        return (bool)$value;
    }
}