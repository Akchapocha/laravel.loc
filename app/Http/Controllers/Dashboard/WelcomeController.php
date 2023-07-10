<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\LogoutForm;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class WelcomeController extends Controller
{
    public function index(FormBuilder $formBuilder): View
    {
        $logout = $formBuilder->create(LogoutForm::class, [
            'method' => 'POST',
            'url' => route('logout')
        ]);

        return view('welcome', compact('logout'));
    }
}
