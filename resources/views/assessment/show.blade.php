@extends('home')

@section('content')
<style>
    .btn-custom {
    border: 1px solid #EE2D7B;
    color: white;
    border: none;
}
.form-control:focus {
    border-color: #EE2D7B !important;
    box-shadow: 0 0 5px rgba(238, 45, 123, 0.5);
       }
       .btn-primary{
        background-color: #EE2D7B !important;
        border: none;
    }
    .btn-primary:hover{
        background-color: #EE2D7B !important;
        border: none;
    }
    .form-control:focus {
    border-color: #EE2D7B !important;
    box-shadow: 0 0 5px rgba(238, 45, 123, 0.5);
}

</style>
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header">
            <h3 class="mb-0">Assessment Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr><th>First Name:</th><td>{{ $assessment->first_name }}</td></tr>
                    <tr><th>Middle Name:</th><td>{{ $assessment->middle_name }}</td></tr>
                    <tr><th>Last Name:</th><td>{{ $assessment->last_name }}</td></tr>
                    <tr><th>Primary Phone:</th><td>{{ $assessment->primary_phone }}</td></tr>
                    <tr><th>Alternate Phone:</th><td>{{ $assessment->alternate_phone }}</td></tr>
                    <tr><th>Emergency Phone:</th><td>{{ $assessment->emergency_phone }}</td></tr>
                    <tr><th>Parent Name:</th><td>{{ $assessment->parent_name }}</td></tr>
                    <tr><th>School Name:</th><td>{{ $assessment->school_name }}</td></tr>
                    <tr><th>Notes:</th><td>{{ $assessment->notes }}</td></tr>
                    <tr><th>Assessment Type:</th><td>{{ $assessment->assessment_type }}</td></tr>
                    <tr><th>ELD Level:</th><td>{{ $assessment->eld_level }}</td></tr>
                    <tr><th>Date Consent Received:</th><td>{{ $assessment->date_consent_received }}</td></tr>
                    <tr><th>Due Date:</th><td>{{ $assessment->due_date }}</td></tr>
                    <tr><th>Status:</th><td>{{ $assessment->status }}</td></tr>
                    <tr>
    <th>Attachments:</th>
    <td>
        @if($assessment->attachments)
            <div class="attachment-list">
                @foreach(json_decode($assessment->attachments) as $attachment)
                    <div class="attachment-item mb-2">
                    <a href="{{ asset(path: 'storage/app/public/' . $attachment) }}" target="_blank" class="btn btn-sm" style="background-color: #EE2D7B; color: white;" title="View File">
    <i class="bi bi-eye"></i> View Attachment
</a>

                    </div>
                @endforeach
            </div>
        @else
            <span class="text-muted">No Attachments</span>
        @endif
    </td>
</tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('assessments.index') }}" class="btn btn-secondary" style="border: none; background-color: #EE2D7B !important;"s>Back</a>
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
