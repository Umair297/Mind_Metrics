<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    // Show all schools
    public function index()
    {
        $schools = School::all();
        return view('schools.list', compact('schools'));
    }

    // Show create form
    public function create()
    {
        return view('schools.create');
    }

    // Store new school
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'contact_number' => 'nullable',
        ]);

        School::create($request->all());
        return redirect()->route('schools.index')->with('success', 'School added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $school = School::findOrFail($id);
        return view('schools.edit', compact('school'));
    }

    // Update school
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'nullable',
            'contact_number' => 'nullable',
        ]);

        $school = School::findOrFail($id);
        $school->update($request->all());

        return redirect()->route('schools.index')->with('success', 'School updated successfully!');
    }

    // Delete school
    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();

        return redirect()->route('schools.index')->with('success', 'School deleted successfully!');
    }
}
