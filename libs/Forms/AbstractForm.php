<?php declare(strict_types=1);

namespace libs\Forms;

use libs\Validators\AbstractValidator;
use libs\Validators\RepeatValidator;
use libs\Validators\RequiredValidator;

abstract class AbstractForm
{
    /** @var array */
    private $data;

    /** @var array */
    private $errorMessages;

    /**
     * @return array
     */
    abstract protected function validators(): array;

    /**
     * @param array $data
     * @param bool $strict
     * @param bool $trimValues
     * @return $this
     */
    public function load(array $data, bool $strict = true, bool $trimValues = true): self
    {
        foreach ($data as $field => $value) {
            if ($strict && !isset($this->validators()[$field])) {
                throw new \RuntimeException("Validator for {$field} field not set");
            }

            $this->data[$field] = $trimValues ? trim($value) : $value;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->validators() as $fieldName => $fieldValidators) {
            if(is_array($fieldValidators)) {
                foreach ($fieldValidators as $validator) {
                    if(!$this->validateField($fieldName, $validator)) {
                        break;
                    }
                }
            } else {
                $this->validateField($fieldName, $fieldValidators);
            }
        }

        return empty($this->errorMessages);
    }

    /**
     * @param string $fieldName
     * @param AbstractValidator $validator
     * @return bool
     */
    private function validateField(string $fieldName, AbstractValidator $validator): bool
    {
        if($validator instanceof RepeatValidator) {
            $result = $validator->validate($this->data[$fieldName], $this->data);
        } elseif($validator instanceof RequiredValidator) {
            $result = $validator->validate($this->data[$fieldName]);
        } else {
            $result = !isset($this->data[$fieldName])
                || empty($this->data[$fieldName])
                || $validator->validate($this->data[$fieldName]);
        }

        if (!$result) {
            $this->errorMessages[$fieldName][] = $validator->getErrorMessage();

            return false;
        } else {
            return true;
        }
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}