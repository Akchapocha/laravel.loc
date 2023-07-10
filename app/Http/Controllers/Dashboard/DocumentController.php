<?php

namespace App\Http\Controllers\Dashboard;

use App\Forms\CreateForm;
use App\Forms\EditForm;
use App\Forms\LogoutForm;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class DocumentController extends Controller
{
    public function index(FormBuilder $formBuilder): View
    {
        $form = $formBuilder->create(CreateForm::class, [
            'method' => 'POST',
            'url' => route('create')
        ]);

        $logout = $formBuilder->create(LogoutForm::class, [
            'method' => 'POST',
            'url' => route('logout')
        ]);

        return view('create_document', compact('logout', 'form'));
    }

    public function get(Request $request): string
    {
        $document = DB::table('documents')->where('id', '=', $request->all()['id'])->get();
        return json_encode($document->all());
    }

    public function save(Request $request, FormBuilder $formBuilder): RedirectResponse
    {
        $form = $formBuilder->create(CreateForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        Document::create([
            'title' => $request->title,
            'name' => $request->lastName . ' ' . $request->firstName . ' ' . $request->middleName,
            'birthdate' => $request->birthdate,
            'country' => $request->country
        ]);

        return redirect()->route('dashboard');
    }

    public function delete(Request $request): string
    {
        $id =  $request->post()['id'];
        $deleted = DB::table('documents')->where('id', '=', $id)->delete();
        if ($deleted) {
            return json_encode('Документ #' . $id . ' успешно удален');
        }
    }

    public function edit(FormBuilder $formBuilder): View
    {
        $form = $formBuilder->create(EditForm::class, [
            'method' => 'POST',
            'url' => route('update')
        ]);

        $logout = $formBuilder->create(LogoutForm::class, [
            'method' => 'POST',
            'url' => route('logout')
        ]);

        return view('create_document', compact('logout', 'form'));
    }

    public function update(Request $request): RedirectResponse
    {
        $document = $request->all();
        DB::table('documents')->where('id', '=', $document['id'])->update([
            'title' => $document['title'],
            'lastName' => $document['lastName'],
            'firstName' => $document['firstName'],
            'middleName' => $document['middleName'],
            'birthdate' => $document['birthdate'],
            'country' => $document['country'],
        ]);

        return redirect()->route('dashboard');
    }
}
