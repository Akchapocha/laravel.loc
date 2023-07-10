<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', Field::HIDDEN, [
                'rules' => ['required', 'int'],
            ])
            ->add('title', Field::SELECT, [
                'rules' => ['required', 'string'],
                'choices' => ['Паспорт' => 'Паспорт', 'Свид. о рождении' => 'Свид. о рождении', 'Водительское у-е' => 'Водительское у-е'],
                'label' => 'Наименование документа'
            ])
            ->add('lastName', Field::TEXT, [
                'rules' => ['required', 'string'],
                'label' => 'Фамилия'
            ])
            ->add('firstName', Field::TEXT, [
                'rules' => ['required', 'string'],
                'label' => 'Имя'
            ])
            ->add('middleName', Field::TEXT, [
                'rules' => ['required', 'string'],
                'label' => 'Отчество'
            ])
            ->add('birthdate', Field::DATE, [
                'rules' => ['required', 'date'],
                'label' => 'Дата рождения'
            ])
            ->add('country', Field::TEXT, [
                'rules' => ['required'],
                'label' => 'Место рождения (страна)'
            ])
            ->add('Сохранить', Field::BUTTON_SUBMIT);
    }
}
