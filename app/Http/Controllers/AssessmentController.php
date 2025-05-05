<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Document;
use App\Mail\NewAssessmentMail;
use App\Models\School;
use Illuminate\Support\Facades\Mail;

class AssessmentController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        $assignedAssessments = Assessment::whereNotNull('school_id')->get();
        $unassignedAssessments = Assessment::whereNull('school_id')->get();
        $schools = School::all();
    } else {
        $assignedAssessments = Assessment::where('user_id', $user->id)->whereNotNull('school_id')->get();
        $unassignedAssessments = Assessment::where('user_id', $user->id)->whereNull('school_id')->get();
        $schools = School::all();
    }

    return view('assessment.list', compact('assignedAssessments', 'unassignedAssessments', 'schools'));
}

    
    public function create()
    {
        return view('assessment.create');
    }

    public function store(Request $request)
    {
        $assessment = new Assessment();
        $assessment->first_name = $request->first_name;
        $assessment->middle_name = $request->middle_name;
        $assessment->last_name = $request->last_name;
        $assessment->primary_phone = $request->primary_phone;
        $assessment->alternate_phone = $request->alternate_phone;
        $assessment->emergency_phone = $request->emergency_phone;

        $assessment->parent_name = $request->parent_name;
        $assessment->student_language = $request->student_language;
        $assessment->home_language = $request->home_language;
        $assessment->parent_language = $request->parent_language;
        $assessment->case_manager_name = $request->case_manager_name;
        $assessment->case_manager_phone = $request->case_manager_phone;
        $assessment->case_manager_email = $request->case_manager_email;
        $assessment->school_name = $request->school_name;
        $assessment->notes = $request->notes;
        $assessment->assessment_type = $request->assessment_type;
        $assessment->eld_level = $request->eld_level;
        $assessment->date_consent_received = $request->date_consent_received;
        $assessment->due_date = $request->due_date;

        $assessment->anticipated_iep_date = $request->anticipated_iep_date;
        $assessment->provider = $request->provider;
        $assessment->assessment_areas = $request->assessment_areas;
        $assessment->eligibility = $request->eligibility;
        $assessment->status = $request->status;
        $assessment->user_id = auth()->id();
        
  // Handle Multiple File Uploads
if ($request->hasFile('attachments')) {
    $filePaths = [];
    foreach ($request->file('attachments') as $file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('attachments', $filename, 'public');
        $filePaths[] = $filePath;
    }   
    $assessment->attachments = json_encode($filePaths); 
}
        $assessment->save();
        
        Mail::to('umair686061@gmail.com')->send(new NewAssessmentMail($assessment));
        return redirect()->route('assessments.index')->with('success', 'Assessment added successfully!');
        
    }

    public function storeDocument(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document.*' => 'required|mimes:pdf,doc,docx,jpg,png,jpeg|max:2048'
        ]);
    
        $assessment = Assessment::findOrFail($id);
        $assessment->title = $request->title;
        $assessment->description = $request->description;
    
        $filePaths = [];
    
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $filename, 'public');
                $filePaths[] = $path;
            }
    
            // Save all file paths as JSON in the documents column
            $assessment->documents = json_encode($filePaths);
        }
    
        $assessment->save();
    
        return redirect()->route('assessments.index')->with('success', 'Documents uploaded successfully!');
    }
    

 
    public function show($id)
    {
        $assessment = Assessment::findOrFail($id);
        $documents = Document::where('assessment_id', $id)->get();
    
        return view('assessment.show', compact('assessment', 'documents'));
    }
    
    
    public function edit($id)
    {
        $assessment = Assessment::findOrFail($id);
        return view('assessment.list', compact('assessment'));
    }

    public function update(Request $request, $id)
    {
        $assessment = Assessment::findOrFail($id);
    
        $assessment->first_name = $request->first_name;
        $assessment->middle_name = $request->middle_name;
        $assessment->last_name = $request->last_name;
        $assessment->primary_phone = $request->primary_phone;
        $assessment->alternate_phone = $request->alternate_phone;
        $assessment->emergency_phone = $request->emergency_phone;
        $assessment->parent_name = $request->parent_name;
        $assessment->student_language = $request->student_language;
        $assessment->home_language = $request->home_language;
        $assessment->parent_language = $request->parent_language;
        $assessment->case_manager_name = $request->case_manager_name;
        $assessment->case_manager_phone = $request->case_manager_phone;
        $assessment->case_manager_email = $request->case_manager_email;
        $assessment->school_name = $request->school_name;
        $assessment->notes = $request->notes;
        $assessment->assessment_type = $request->assessment_type;
        $assessment->eld_level = $request->eld_level;
        $assessment->date_consent_received = $request->date_consent_received;
        $assessment->due_date = $request->due_date;
        $assessment->anticipated_iep_date = $request->anticipated_iep_date;
        $assessment->provider = $request->provider;
        $assessment->assessment_areas = $request->assessment_areas;
        $assessment->eligibility = $request->eligibility;
        $assessment->status = $request->status;




    

        if ($request->hasFile('attachments')) {
            $filePaths = [];
            foreach ($request->file('attachments') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('attachments', $filename, 'public');
                $filePaths[] = $filePath;
            }   
            $assessment->attachments = json_encode($filePaths); 
        }
        $assessment->save();
    
        return redirect()->route('assessments.index')->with('success', 'Assessment updated successfully!');
    }
    

    public function calendarData()
{
    $assessments = Assessment::select('id', 'due_date', 'first_name', 'last_name')->get();

    $events = $assessments->map(function ($item) {
        return [
            'title' => $item->first_name . ' ' . $item->last_name,
            'start' => $item->due_date,
            'url' => route('assessments.show', $item->id), // optional
        ];
    });

    return response()->json($events);
}

public function setSchool(Request $request, $id)
{
    
    $assessment = Assessment::findOrFail($id);
    $assessment->school_id = $request->school_id;
    $assessment->save();

    return redirect()->back()->with('success', 'School assigned successfully.');
}


    public function destroy($id)
    {
        $assessment = Assessment::findOrFail($id);
        $assessment->delete();

        return redirect()->route('assessments.index')->with('success', 'Assessment deleted successfully!');
    }
}
