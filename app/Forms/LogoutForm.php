<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class LogoutForm extends Form
{
    public function buildForm()
    {
        $this->add('Выход', Field::BUTTON_SUBMIT);
    }
}
