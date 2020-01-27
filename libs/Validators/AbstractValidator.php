<?php declare(strict_types=1);

namespace libs\Validators;

abstract class AbstractValidator
{
    /** @var string */
    private $errorMessage;

    /** @var array */
    protected $options;

    /**
     * @param string $errorMessage
     * @param array $options
     * @return self
     */
    public static function make(string $errorMessage, array $options = []): self
    {
        return new static($errorMessage, $options);
    }

    /**
     * @param string $errorMessage
     * @param array $options
     */
    public function __construct(string $errorMessage, array $options = [])
    {
        $this->errorMessage = $errorMessage;
        $this->options = $options;
    }

    /**
     * @param mixed $value
     * @param array $params
     * @return bool
     */
    abstract public function validate($value, array $params = []): bool;

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}