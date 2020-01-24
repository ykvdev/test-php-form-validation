<?php declare(strict_types=1);

namespace app\forms;

use libs\Forms\AbstractForm;
use libs\Forms\Validators\EmailValidator;
use libs\Forms\Validators\StringValidator;
use libs\Forms\Validators\PhoneValidator;
use libs\Forms\Validators\RequiredValidator;

class ContactForm extends AbstractForm
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
                PhoneValidator::make('Phone format is not correct (example: +380987654321)'),
            ],

            'full_name' => [
                StringValidator::make(
                    'Full name length incorrect (min: 6, max: 50)',
                    ['min' => 6, 'max' => 50]
                ),
            ],

            'message' => [
                RequiredValidator::make('Message is required'),
                StringValidator::make(
                    'Message length incorrect (min 30 symbols)',
                    ['min' => 30]
                ),
            ],
        ];
    }
}