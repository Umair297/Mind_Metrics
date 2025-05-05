<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Assessment;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
  public function index($assessment_id)
{
    $documents = Document::with('assessment')
    ->where('assessment_id', $assessment_id)
    ->whereNull('multi_documents') 
    ->latest()
    ->get();


    $multidocuments = Document::with('assessment')
    ->where('assessment_id', $assessment_id)
    ->whereNotNull('multi_documents') 
    ->latest()
    ->get();


    $assessment = Assessment::findOrFail($assessment_id);
    return view('documents.list', compact('documents', 'assessment'));
}

    public function create()
    {
        $assessments = Assessment::all();
        return view('documents.create', compact('assessments'));
    }

    public function store(Request $request)
    {
        $document = new Document();
        $document->title = $request->input('title');
        $document->assessment_id = $request->input('assessment_id');
        $document->description = $request->input('description');
    
        if ($request->hasFile('document')) {
            $document->document = $request->file('document')->store('documents');
        }
        $document->save();
    
        if ($request->hasFile('multi_documents')) {
            $multiPaths = [];
            foreach ($request->file('multi_documents') as $file) {
                $multiPaths[] = $file->store('documents/multi');
            }
            $document->multi_documents = json_encode($multiPaths);
            $document->save();
        }

        return redirect()->route('documents.index', ['assessment_id' => $document->assessment_id])
                         ->with('success', 'Document created successfully.');
    }

    public function storeMulti(Request $request)
    {
        $document = new Document();
        $document->assessment_id = $request->assessment_id;
        $document->title = null;
        $document->description = null;
        $document->document = null;
    
        $document->save(); 
    
        if ($request->hasFile('multi_documents')) {
            $multiPaths = [];
            foreach ($request->file('multi_documents') as $file) {
                $multiPaths[] = $file->store('documents/multi');
            }
            $document->multi_documents = json_encode($multiPaths);
            $document->save();
        }
    
        return redirect()->route('documents.index', ['assessment_id' => $document->assessment_id])
                         ->with('success', 'Multiple documents uploaded successfully.');
    }
    

     
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $assessments = Assessment::all();  
        return view('documents.edit', compact('document', 'assessments')); 
    }
    
    

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
    
        $document->title = $request->input('title');
        $document->description = $request->input('description');
    
        if ($request->hasFile('document')) {
            $document->document = $request->file('document')->store('documents');
        }

        if ($request->hasFile('multi_documents')) {
            $multiPaths = [];
            foreach ($request->file('multi_documents') as $file) {
                $multiPaths[] = $file->store('documents/multi');
            }
            $document->multi_documents = json_encode($multiPaths);
        }
    
        $document->save();
    
        return redirect()->route('documents.index', ['assessment_id' => $document->assessment_id])
                         ->with('success', 'Document updated successfully.');
    }
    

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
    
        if ($document->document) {
            Storage::delete($document->document);
        }
    
        if ($document->multi_documents) {
            $multiDocs = json_decode($document->multi_documents, true);
            if (is_array($multiDocs)) {
                foreach ($multiDocs as $file) {
                    Storage::delete($file);
                }
            }
        }
    
        $document->delete();
    
        return redirect()->route('documents.index', ['assessment_id' => $document->assessment_id])
                         ->with('success', 'Document deleted successfully!');
    }
    
}
