<?php declare(strict_types=1);

namespace libs\Forms;

use libs\Forms\Validators\AbstractValidator;
use libs\Forms\Validators\RepeatValidator;
use libs\Forms\Validators\RequiredValidator;

abstract class AbstractForm
{
    /** @var array */
    private $data;

    /** @var array */
    private $errorMessages;
    
    abstract protected function validators(): array;

    public function load(array $data, bool $strict = true, bool $trimValues = true): self
    {
        foreach ($data as $field => &$value) {
            $value = $trimValues ? trim($value) : $value;

            if ($strict && !isset($this->validators()[$field])) {
                throw new \RuntimeException("Validator for {$field} field not set");
            }

            $this->data[$field] = $value;
        }

        return $this;
    }

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

    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }
}