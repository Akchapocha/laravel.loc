<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'email', [
                'rules' => ['required', 'string', 'email'],
                'label' => 'Email'
            ])
            ->add('password', 'password', [
                'rules' => ['required', 'string'],
                'label' => 'Пароль'
            ])
            ->add('remember', 'checkbox', [
                'label' => 'Запомнить меня'
            ])
            ->add('Войти', 'submit');
    }
}
