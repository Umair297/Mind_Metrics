@extends('home')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header">
            <h3 class="mb-0">Service Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
            <tbody>
                    <tr><th>First Name:</th><td>{{ $service->student_first_name }}</td></tr>
                    <tr><th>Middle Name:</th><td>{{ $service->student_middle_name }}</td></tr>
                    <tr><th>Last Name:</th><td>{{ $service->student_last_name }}</td></tr>
                    <tr><th>Primary Phone:</th><td>{{ $service->phone_primary }}</td></tr>
                    <tr><th>Alternate Phone:</th><td>{{ $service->phone_alternate }}</td></tr>
                    <tr><th>Emergency Phone:</th><td>{{ $service->phone_emergency }}</td></tr>
                    <tr><th>Parent Name:</th><td>{{ $service->parent_name }}</td></tr>
                    <tr><th>Parent Phone:</th><td>{{ $service->parent_phone }}</td></tr>
                    <tr><th>Parent Email:</th><td>{{ $service->parent_email }}</td></tr>
                    <tr><th>Student Language:</th><td>{{ $service->student_language }}</td></tr>
                    <tr><th>Home Language:</th><td>{{ $service->student_home_language }}</td></tr>
                    <tr><th>Parent Language:</th><td>{{ $service->parent_language }}</td></tr>
                    <tr><th>Case Manager:</th><td>{{ $service->case_manager_name }}</td></tr>
                    <tr><th>Case Manager Phone:</th><td>{{ $service->case_manager_phone }}</td></tr>
                    <tr><th>Case Manager Email:</th><td>{{ $service->case_manager_email }}</td></tr>
                    <tr><th>School Name:</th><td>{{ $service->school_name }}</td></tr>
                    <tr><th>Notes:</th><td>{{ $service->notes }}</td></tr>
                    <tr><th>Service Type:</th><td>{{ $service->services_type }}</td></tr>
                    <tr><th>ELD Level:</th><td>{{ $service->eld_level }}</td></tr>
                    <tr><th>Service Minutes:</th><td>{{ $service->service_minutes }}</td></tr>
                    <tr><th>Frequency:</th><td>{{ $service->frequency }}</td></tr>
                    <tr><th>Provider:</th><td>{{ $service->provider }}</td></tr>
                    <tr><th>Eligibility:</th><td>{{ $service->eligibility }}</td></tr>
                    <tr><th>Status:</th><td>{{ $service->status }}</td></tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('services.index') }}" class="btn btn-secondary" style="border: none; background-color: #EE2D7B !important;">Back</a>
        </div>

    <div class="container">
    <div class="row">
        @foreach($documents as $document)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-lg" style="background-color: #f8f9fa;">
                    <div class="card-body p-4">
                        <h5 class="card-title text-center fw-bold">{{ $document->title }}</h5>
                        <p class="card-text text-muted mb-3" style="min-height: 60px;">
                            {{ \Illuminate\Support\Str::limit($document->description, 100) }}
                        </p>
                        <div class="d-flex justify-content-center">
                            @if($document->document)
                                <a href="{{ asset('/storage/app/' . $document->document) }}" 
                                   class="btn btn-sm" 
                                   style="background-color: #EE2D7B; color: white;" 
                                   target="_blank">
                                    Open Document
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

    </div>
</div>
@endsection
