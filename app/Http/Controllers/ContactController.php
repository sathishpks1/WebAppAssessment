<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{

    private function _view(Person $person, Contact $contact = null){

        $countryCodes= app('App\Http\Controllers\CountryController')->fetchCountries();
        
        return view('contacts.create', compact('person', 'contact', 'countryCodes'));

    }

    public function create(Person $person)
    {

        return $this->_view($person);
    }

    public function store(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'country_code' => 'required|string',
            'number' => 'required|string|size:9',
        ]);
    
        try {
            $contact = $person->contacts()->create($validatedData);
            return redirect()->route('people.view', $person)->with('success', 'Contact added successfully!');
        } catch (\Exception $e) {
            Log::error('Error adding contact: ' . $e->getMessage());
            dd($e->getMessage()); 
            return redirect()->back()->withErrors(['An error occurred while adding the contact.'])->withInput();
        }
    }
    
    

    public function edit(Person $person, Contact $contact)
    {
        return $this->_view($person, $contact);
    }

    public function update(Request $request, Person $person, Contact $contact)
    {
        $validatedData = $request->validate([
            'country_code' => 'required|string',
            'number' => 'required|string|size:9',
        ]);

        $contact->update($validatedData);

        return redirect()->route('people.view', $person)->with('success', 'Contact updated successfully!');
    }


    public function destroy(Person $person, Contact $contact)
    {
        try {
            DB::beginTransaction(); 

            $contact->delete(); 

            DB::commit(); 

            return redirect()->route('people.view', $person)->with('success', 'Contact deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback(); 

            \Log::error('Delete contact error: ' . $e->getMessage());

            session()->flash('error', 'An error occurred while deleting the contact.');

            return redirect()->route('people.view', $person);
        }
    }





}
