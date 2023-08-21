<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Validation\Rule;
use App\Models\PersonArchive;
use Illuminate\Support\Facades\DB;


class PersonController extends Controller
{
    public function listPeople()
    {
        $people = Person::orderBy('created_at', 'desc')->get(); 
        return view('list_people', ['people' => $people]);
    }

    public function addPersonForm()
    {
        return view('add_person'); 
    }

    public function addPerson(Request $request)
{
    try {
        $validatedData = $request->validate([
            'member_id' => 'required|min:6|unique:people', // Use unique validation rule directly
            'name' => 'required|string|min:5',
            'email' => 'required|email|max:255|unique:people,email',
        ]);

        $person = new Person();
        $person->member_id = $validatedData['member_id'];
        $person->name = $validatedData['name'];
        $person->email = $validatedData['email'];
        $person->save();

        return redirect()->back()->with([
            'success' => 'Person added successfully!',
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    }
}


    public function edit(Person $person)
    {
        return view('add_person', ['person' => $person]);
    }
    
    public function update(Request $request, Person $person)
    {

        try {
            $validatedData = $request->validate([
                'member_id' => [
                    'required',
                    'min:6',
                    Rule::unique('people')->ignore($person->id),
                ],
                'name' => 'required|string|min:5',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('people', 'email')->ignore($person->id),
                ],
            ]);
    
            // Update the person's information based on $validatedData
            $person->update([
                'member_id' => $validatedData['member_id'],
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
    
            return redirect()->route('people.edit', $person->id)->with('success', 'Person updated successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }


    public function view(Person $person)
    {
        return view('view_person', ['person' => $person]);
    }


    public function delete(Person $person)
{
    try {
        DB::beginTransaction(); 

        
        PersonArchive::create([
            'member_id' => $person->member_id,
            'name' => $person->name,
            'email' => $person->email,
        ]);

        $person->delete();

        DB::commit(); 

        return redirect()->route('list-people')->with('success', 'Person deleted and archived successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Delete and archive error: ' . $e->getMessage());
        session()->flash('error', 'An error occurred while deleting the person.');

        // echo $e->getMessage();exit;
        return redirect()->route('list-people');
    }
}

    
    


    



}
