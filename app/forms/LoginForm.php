<?php declare(strict_types=1);

namespace app\forms;

use libs\Forms\AbstractForm;
use libs\Validators\EmailValidator;
use libs\Validators\RequiredValidator;

class LoginForm extends AbstractForm
{
    /**
     * {@inheritDoc}
     */
    protected function validators(): array
    {
        return [
            'email' => [
                RequiredValidator::make('E-mail is required'),
                EmailValidator::make('E-mail is not correct'),
            ],

            'password' => RequiredValidator::make('Password is required'),
        ];
    }
}