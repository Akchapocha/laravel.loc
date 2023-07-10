<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class RegisterForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => ['required', 'string']
            ])
            ->add('email', Field::EMAIL, [
                'rules' => ['required', 'string', 'email', 'unique:users']
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => ['required', 'confirmed', 'min:8']
            ])
            ->add('password_confirmation', Field::PASSWORD)
            ->add('Зарегистрироваться', Field::BUTTON_SUBMIT);
    }
}
