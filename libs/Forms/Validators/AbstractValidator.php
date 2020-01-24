<?php declare(strict_types=1);

namespace libs\Forms\Validators;

abstract class AbstractValidator
{
    /** @var string */
    private $errorMessage;

    public static function make(string $errorMessage): self
    {
        $validator = new static();
        $validator->setErrorMessage($errorMessage);

        return $validator;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    abstract public function validate($value): bool;
}