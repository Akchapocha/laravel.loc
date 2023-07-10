<?php

namespace App\Http\Controllers\Auth;

use App\Forms\LoginForm;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class LoginController extends Controller
{
    public function create(FormBuilder $formBuilder): View
    {
        $form = $formBuilder->create(LoginForm::class, [
            'method' => 'POST',
            'url' => route('login')
        ]);
        return view('auth.login', compact('form'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(LoginForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
