<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacts;
use App\Models\Role;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('panel.contacts.index')->with([
            'contacts' => Contact::all(),
            'roles' => Role::all(),
        ]);
    }

    public function show($contact){
        $contact = Contact::find($contact);
        return view('panel.contacts.show')->with([
            'contact' => $contact,
            'roles' => Role::all(),
        ]);
    }

    public function status_update(Request $request, $contact){
        $contact = Contact::find($contact);
        $contact->status = $request->status;
        $contact->save();

        return redirect()
            ->route('dashboard.contact.index')
            ->withSuccess("El mensaje {$contact->id} fue actualizada con éxito");
    }
}
