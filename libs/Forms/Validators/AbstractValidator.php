<?php declare(strict_types=1);

namespace libs\Forms\Validators;

abstract class AbstractValidator
{
    /** @var string */
    private $errorMessage;

    /** @var array */
    protected $options;

    public static function make(string $errorMessage, array $options = []): self
    {
        return new static($errorMessage, $options);
    }

    public function __construct(string $errorMessage, array $options = [])
    {
        $this->errorMessage = $errorMessage;
        $this->options = $options;
    }

    abstract public function validate($value, array $params = []): bool;

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}