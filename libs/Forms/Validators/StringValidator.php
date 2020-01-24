<?php declare(strict_types=1);

namespace libs\Forms\Validators;

class StringValidator extends AbstractValidator
{
    public function validate($value, array $params = []): bool
    {
        $length = mb_strlen($value);

        return is_string($value)
            && (!isset($this->options['min']) || $length >= $this->options['min'])
            && (!isset($this->options['max']) || $length <= $this->options['max']);
    }
}