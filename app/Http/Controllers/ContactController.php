<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Contacts;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('store');
    }

    public function index(){
        return view('panel.contacts.index')->with([
            'contacts' => Contact::all(),
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function show(Contact $contact){
        return view('panel.contacts.show')->with([
            'contact' => $contact,
            'roles' => Role::where('is_deleted',false)->get(),
        ]);
    }

    public function status_update(Request $request, Contact $contact){
        $contact->status = $request->status;
        $contact->save();

        return redirect()
            ->route('dashboard.contact.index')
            ->withSuccess("El mensaje {$contact->id} fue actualizada con éxito");
    }

    public function store(Request $request){
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone_number = $request->phone_number;
        $contact->message = $request->message;
        $contact->attended_by = Auth::user()->id;
        $contact->save();

        return redirect()
            ->route('contact')
            ->withSuccess("El formulario de contacto ha sido enviado con éxito");
    }
}
