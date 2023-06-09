<?php declare(strict_types=1);

namespace app\forms;

use libs\Forms\AbstractForm;
use libs\Validators\EmailValidator;
use libs\Validators\RepeatValidator;
use libs\Validators\StringValidator;
use libs\Validators\PhoneValidator;
use libs\Validators\RequiredValidator;

class RegisterForm extends AbstractForm
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

            'phone' => [
                RequiredValidator::make('Phone is required'),
                PhoneValidator::make('Phone format is not correct (example: +380987654321)'),
            ],

            'full_name' => [
                RequiredValidator::make('Full name is required'),
                StringValidator::make(
                    'Full name length incorrect (min: 6, max: 50)',
                    ['min' => 6, 'max' => 50]
                ),
            ],

            'password' => [
                RequiredValidator::make('Password is required'),
                StringValidator::make(
                    'Password length incorrect (min 6 symbols)',
                    ['min' => 6]
                ),
            ],

            'repassword' => [
                RequiredValidator::make('Repeat password is required'),
                RepeatValidator::make('Passwords is not match', ['original_field' => 'password'])
            ],
        ];
    }
}