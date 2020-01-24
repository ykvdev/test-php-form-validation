<?php declare(strict_types=1);

namespace libs\Forms\Validators;

class RepeatValidator extends AbstractValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, array $params = []): bool
    {
        return strcmp($value, $params[$this->options['original_field']] ?? null) === 0;
    }
}