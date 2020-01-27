<?php declare(strict_types=1);

namespace libs\Validators;

class StringValidator extends AbstractValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, array $params = []): bool
    {
        $length = mb_strlen($value);

        return is_string($value)
            && (!isset($this->options['min']) || $length >= $this->options['min'])
            && (!isset($this->options['max']) || $length <= $this->options['max']);
    }
}