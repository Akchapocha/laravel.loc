<?php

namespace App\Http\Controllers\Auth;

use App\Forms\RegisterForm;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class RegisterController extends Controller
{
    public function create(FormBuilder $formBuilder): View
    {
        $form = $formBuilder->create(RegisterForm::class, [
            'method' => 'POST',
            'url' => route('register')
        ]);
        return view('auth.register', compact('form'));
    }

    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(RegisterForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
