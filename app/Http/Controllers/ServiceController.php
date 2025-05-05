<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewServiceNotification;
use App\Models\ServiceDocument;


class ServiceController extends Controller
{
    
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $services = Service::all();
        } else {
            $services = auth()->user()->services;
        }
    
        return view('services.list', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }
    public function store(Request $request)
    {
    $service = new Service();
    $service->student_first_name = $request->student_first_name;
    $service->student_middle_name = $request->student_middle_name;
    $service->student_last_name = $request->student_last_name;
    $service->phone_primary = $request->phone_primary;
    $service->phone_alternate = $request->phone_alternate;
    $service->phone_emergency = $request->phone_emergency;
    $service->parent_name = $request->parent_name;
    $service->parent_phone = $request->parent_phone;
    $service->parent_email = $request->parent_email;
    $service->student_language = $request->student_language;
    $service->student_home_language = $request->student_home_language;
    $service->parent_language = $request->parent_language;
    $service->case_manager_name = $request->case_manager_name;
    $service->case_manager_phone = $request->case_manager_phone;
    $service->case_manager_email = $request->case_manager_email;
    $service->school_name = $request->school_name;
    $service->notes = $request->notes;
    $service->services_type = $request->services_type;
    $service->eld_level = $request->eld_level;
    $service->service_minutes = $request->service_minutes;
    $service->frequency = $request->frequency;
    $service->provider = $request->provider;    
    $service->eligibility = $request->eligibility;
    $service->status = $request->status;
    $service->user_id = auth()->id();

    $service->save();
    // Send email to admin
    Mail::to('umair686061@gmail.com')->send(new NewServiceNotification($service));

    return redirect()->route('services.index')->with('success', 'Service added successfully.');
}

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        $documents = ServiceDocument::where('service_id', $id)->get();

        return view('services.show', compact('service', 'documents'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
    
    $service->student_first_name = $request->student_first_name;
    $service->student_middle_name = $request->student_middle_name;
    $service->student_last_name = $request->student_last_name;
    $service->phone_primary = $request->phone_primary;
    $service->phone_alternate = $request->phone_alternate;
    $service->phone_emergency = $request->phone_emergency;
    $service->parent_name = $request->parent_name;
    $service->parent_phone = $request->parent_phone;
    $service->parent_email = $request->parent_email;
    $service->student_language = $request->student_language;
    $service->student_home_language = $request->student_home_language;
    $service->parent_language = $request->parent_language;
    $service->case_manager_name = $request->case_manager_name;
    $service->case_manager_phone = $request->case_manager_phone;
    $service->case_manager_email = $request->case_manager_email;
    $service->school_name = $request->school_name;
    $service->notes = $request->notes;
    $service->services_type = $request->services_type;
    $service->eld_level = $request->eld_level;
    $service->service_minutes = $request->service_minutes;
    $service->frequency = $request->frequency;
    $service->provider = $request->provider;    
    $service->eligibility = $request->eligibility;
    $service->status = $request->status;
    
        $service->save();
    
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }
    
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
