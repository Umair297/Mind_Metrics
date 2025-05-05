<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\ServiceDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceDocumentController extends Controller
{
    public function index($service_id)
    {
        $documents = ServiceDocument::with('service')
        ->where('service_id', $service_id)
        ->whereNull('multi_documents') 
        ->latest()
        ->get();
    
        $service = Service::findOrFail($service_id);
        return view('service_documents.list', compact('documents', 'service', 'service_id'));
    }
    
        public function create()
        {
            $services = Service::all();
            return view('service_documents.create', compact('services'));
        }
    
        public function store(Request $request)
        {
            $document = new ServiceDocument();
            $document->title = $request->input('title');
            $document->service_id = $request->input('service_id');
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
    
            return redirect()->route('service_documents.index', ['service_id' => $document->service_id])
                             ->with('success', 'Document created successfully.');
        }
    
        public function storeMulti(Request $request)
        {
            $document = new ServiceDocument();
            $document->service_id = $request->service_id;
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
        
            return redirect()->route('service_documents.index', ['service_id' => $document->service_id])
                             ->with('success', 'Multiple documents uploaded successfully.');
        }
        
         
        public function edit($id)
        {
            $document = ServiceDocument::findOrFail($id);
            $services = Service::all();  
            return view('service_documents.edit', compact('document', 'services')); 
        }
        
        
    
        public function update(Request $request, $id)
        {
            $document = ServiceDocument::findOrFail($id);
        
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
        
            return redirect()->route('service_documents.index', ['service_id' => $document->service_id])
                             ->with('success', 'Document updated successfully.');
        }
        
    
        public function destroy($id)
        {
            $document = ServiceDocument::findOrFail($id);
        
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
        
            return redirect()->route('service_documents.index', ['service_id' => $document->service_id])
                             ->with('success', 'Document deleted successfully!');
        }
}
