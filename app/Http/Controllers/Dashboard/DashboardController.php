<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\LogoutForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class DashboardController extends Controller
{
    public function index(FormBuilder $formBuilder): View
    {
        $logout = $formBuilder->create(LogoutForm::class, [
            'method' => 'POST',
            'url' => route('logout')
        ]);

        $documents = DB::table('documents')->get();
        return view('dashboard', compact('logout', 'documents'));
    }
}
