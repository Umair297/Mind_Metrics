@extends('home')

@section('content')
<style>
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
</style>
<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #333;">Assessment</h1>
        <button type="button" 
                class="btn-employee" 
                style="color: white; background-color: #EE2D7B; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;"
                data-bs-toggle="modal" 
                data-bs-target="#createEmployeeModal"
                onmouseover="this.style.background=' #EE2D7B'" 
                onmouseout="this.style.background=' #EE2D7B'">
            Create Assessment
        </button>
    </div>
    <div class="card-datatable table-responsive text-nowrap">
    <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Assessment Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignedAssessments as $index => $assessment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $assessment->first_name }} {{ $assessment->last_name }}</td>
                    <td>{{ $assessment->school->name ?? 'NA' }}</td>
                    <td>{{ $assessment->assessment_type }}</td>
                    <td>
                        <span class="badge 
                            @if($assessment->status == 'Assigned') bg-success
                            @elseif($assessment->status == 'Received') bg-warning
                            @elseif($assessment->status == 'In Progress') bg-primary
                            @elseif($assessment->status == 'Completed') bg-secondary
                            @endif">
                            {{ $assessment->status }}
                        </span>
                    </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                 
                                    <a class="dropdown-item" href="{{ route('documents.index',$assessment->id) }}">
                                        <i class="fa fa-file-alt me-1"></i> Document
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#schoolModal{{ $assessment->id }}">
                                        <i class="fa fa-school me-1"></i> School
                                    </a>
                                    @endif
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAssessmentModal{{ $assessment->id }}">
                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </a>
                                    <!-- View Button -->
                                    <a class="dropdown-item" href="{{ route('assessments.show', $assessment->id) }}">
                                                <i class="ti ti-eye me-1"></i> View
                                            </a>
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $assessment->id }})">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </a>
                                        <form id="delete-employe-form-{{ $assessment->id }}" action="{{ route('assessments.destroy', $assessment->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        <!-- School Modal -->
<div class="modal fade" id="schoolModal{{ $assessment->id }}" tabindex="-1" aria-labelledby="schoolModalLabel{{ $assessment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('assessments.setSchool', $assessment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="schoolModalLabel{{ $assessment->id }}">Assign School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="school_id">Select School</label>
                    <select name="school_id" id="school_id" class="form-select" required>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ $assessment->school_id == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>





                        <!-- Edit Employee Modal -->
        <div class="modal fade" id="editAssessmentModal{{ $assessment->id }}" tabindex="-1" aria-labelledby="editAssessmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAssessmentModalLabel">Edit Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAssessmentForm" action="{{ route('assessments.update', $assessment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ $assessment->first_name }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $assessment->middle_name }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $assessment->last_name }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="primary_phone" class="form-label">Primary Phone</label>
                        <input type="text" class="form-control" id="primary_phone" name="primary_phone" value="{{ $assessment->primary_phone }}" required>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="alternate_phone" class="form-label">Alternate Phone</label>
                        <input type="text" class="form-control" id="alternate_phone" name="alternate_phone" value="{{ $assessment->alternate_phone }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_phone" class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" value="{{ $assessment->emergency_phone }}">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent_name" class="form-label">Parent Name</label>
                        <input type="text" class="form-control" id="parent_name" name="parent_name" value="{{ $assessment->parent_name }}" required>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="student_language" class="form-label">Student Language</label>
                        <input type="text" class="form-control" id="student_language" name="student_language" value="{{ $assessment->student_language }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="home_language" class="form-label">Home Language</label>
                        <input type="text" class="form-control" id="home_language" name="home_language" value="{{ $assessment->home_language }}">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent_language" class="form-label">Parent Language</label>
                        <input type="text" class="form-control" id="parent_language" name="parent_language" value="{{ $assessment->parent_language }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_name" class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="case_manager_name" name="case_manager_name" value="{{ $assessment->case_manager_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_phone" class="form-label">Member Phone</label>
                        <input type="text" class="form-control" id="case_manager_phone" name="case_manager_phone" value="{{ $assessment->case_manager_phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_email" class="form-label">Member email</label>
                        <input type="text" class="form-control" id="case_manager_email" name="case_manager_email" value="{{ $assessment->case_manager_email }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes" value="{{ $assessment->notes }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="assessment_type" class="form-label">Assessment Type</label>
                        <select class="form-select" id="assessment_type" name="assessment_type" required>
                            <option value="Initial"{{ $assessment->assessment_type == 'Initial' ? 'selected' : '' }}>Initial</option>
                            <option value="Triennial"{{ $assessment->assessment_type == 'Triennial' ? 'selected' : '' }}>Triennial</option>
                            <option value="Re-Evaluation"{{ $assessment->assessment_type == 'Re-Evaluation' ? 'selected' : '' }}>Re-Evaluation</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eld_level" class="form-label">ELD Level</label>
                        <select class="form-select" id="eld_level" name="eld_level" required>
                        <option value="1" {{ $assessment->eld_level == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $assessment->eld_level == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $assessment->eld_level == '3' ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $assessment->eld_level == '4' ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $assessment->eld_level == '5' ? 'selected' : '' }}>5</option>
                        <option value="EO" {{ $assessment->eld_level == 'EO' ? 'selected' : '' }}>EO</option>
                        <option value="RFEP" {{ $assessment->eld_level == 'RFEP' ? 'selected' : '' }}>RFEP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_consent_received" class="form-label">Date Consent</label>
                        <input type="date" class="form-control" id="date_consent_received" name="date_consent_received" value="{{ $assessment->date_consent_received }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $assessment->due_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="anticipated_iep_date" class="form-label">Anticipated_iep Date</label>
                        <input type="date" class="form-control" id="anticipated_iep_date" name="anticipated_iep_date" value="{{ $assessment->anticipated_iep_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" class="form-control" id="provider" name="provider" value="{{ $assessment->provider }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="assessment_areas" class="form-label">Assessment Areas</label>
                        <select class="form-select" id="assessment_areas" name="assessment_areas" required>
                            <option value="General Ability"{{ $assessment->assessment_areas == 'General Ability' ? 'selected' : '' }}>General Ability</option>
                            <option value="Social Emotional"{{ $assessment->assessment_areas == 'Social Emotional' ? 'selected' : '' }}>Social Emotional</option>
                            <option value="Adaptive Behavior"{{ $assessment->assessment_areas == 'Adaptive Behavior' ? 'selected' : '' }}>Adaptive Behavior</option>
                            <option value="Language"{{ $assessment->assessment_areas == 'Language' ? 'selected' : '' }}>Language</option>
                            <option value="ERMHS"{{ $assessment->assessment_areas == 'ERMHS' ? 'selected' : '' }}>ERMHS</option>
                            <option value="FBA"{{ $assessment->assessment_areas == 'FBA' ? 'selected' : '' }}>FBA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eligibility" class="form-label">Eligibility</label>
                        <select class="form-select" id="eligibility" name="eligibility" required>
                            <option value="Speech or Language Impairment">Speech or Language Impairment</option>
                            <option value="Intellectual Disabilit">Intellectual Disabilit</option>
                            <option value="Other Health Impairment">Other Health Impairment</option>
                            <option value="Specific Learning Disability">Specific Learning Disability</option>
                            <option value="Autism">Autism</option>
                            <option value="Emotional Disability">Emotional Disability</option>
                            <option value="Deaf-blindness">Deaf-blindness</option>
                            <option value="deafness">deafness</option>
                            <option value="hearing impairment">hearing impairment</option>
                            <option value="multiple disabilities"> multiple disabilities</option>
                            <option value="Orthopedic impairment">Orthopedic impairment</option>
                            <option value="traumatic brain injury">traumatic brain injury</option>
                            <option value="visual impairment">visual impairment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Received"{{ $assessment->status == 'Received' ? 'selected' : '' }}>Received</option>
                            <option value="Assigned"{{ $assessment->status == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="In Progress"{{ $assessment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed"{{ $assessment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Attachments Files</label>
                        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important;">Update Assessment</button>
                </form>
            </div>
        </div>
    </div>
</div>
                    @endforeach
                    <tr>
                        <!-- <td colspan="6" class="text-center">No Assessment found.</td> -->
                    </tr>
            
            </tbody>
        </table>
    </div>
</div>

<hr>

<div class="card">
    <div class="card-header"><h3>Assessments Without Assigned School</h3></div>
    <div class="card-datatable table-responsive text-nowrap">
    <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>School</th>
                    <th>Assessment Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unassignedAssessments as $index => $assessment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $assessment->first_name }} {{ $assessment->last_name }}</td>
                    <td>NA</td>
                    <td>{{ $assessment->assessment_type }}</td>
                    <td>
                        <span class="badge 
                            @if($assessment->status == 'Assigned') bg-success
                            @elseif($assessment->status == 'Received') bg-warning
                            @elseif($assessment->status == 'In Progress') bg-primary
                            @elseif($assessment->status == 'Completed') bg-secondary
                            @endif">
                            {{ $assessment->status }}
                        </span>
                    </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                 
                                    <a class="dropdown-item" href="{{ route('documents.index',$assessment->id) }}">
                                        <i class="fa fa-file-alt me-1"></i> Document
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#schoolModal{{ $assessment->id }}">
                                        <i class="fa fa-school me-1"></i> School
                                    </a>
                                    @endif
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAssessmentModal{{ $assessment->id }}">
                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </a>
                                    <!-- View Button -->
                                    <a class="dropdown-item" href="{{ route('assessments.show', $assessment->id) }}">
                                                <i class="ti ti-eye me-1"></i> View
                                            </a>
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $assessment->id }})">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </a>
                                        <form id="delete-employe-form-{{ $assessment->id }}" action="{{ route('assessments.destroy', $assessment->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>


                        <!-- School Modal -->
<div class="modal fade" id="schoolModal{{ $assessment->id }}" tabindex="-1" aria-labelledby="schoolModalLabel{{ $assessment->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('assessments.setSchool', $assessment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="schoolModalLabel{{ $assessment->id }}">Assign School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="school_id">Select School</label>
                    <select name="school_id" id="school_id" class="form-select" required>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ $assessment->school_id == $school->id ? 'selected' : '' }}>
                                {{ $school->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>





                        <!-- Edit Employee Modal -->
        <div class="modal fade" id="editAssessmentModal{{ $assessment->id }}" tabindex="-1" aria-labelledby="editAssessmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAssessmentModalLabel">Edit Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editAssessmentForm" action="{{ route('assessments.update', $assessment->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  value="{{ $assessment->first_name }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $assessment->middle_name }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $assessment->last_name }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="primary_phone" class="form-label">Primary Phone</label>
                        <input type="text" class="form-control" id="primary_phone" name="primary_phone" value="{{ $assessment->primary_phone }}" required>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="alternate_phone" class="form-label">Alternate Phone</label>
                        <input type="text" class="form-control" id="alternate_phone" name="alternate_phone" value="{{ $assessment->alternate_phone }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_phone" class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" value="{{ $assessment->emergency_phone }}">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent_name" class="form-label">Parent Name</label>
                        <input type="text" class="form-control" id="parent_name" name="parent_name" value="{{ $assessment->parent_name }}" required>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="student_language" class="form-label">Student Language</label>
                        <input type="text" class="form-control" id="student_language" name="student_language" value="{{ $assessment->student_language }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="home_language" class="form-label">Home Language</label>
                        <input type="text" class="form-control" id="home_language" name="home_language" value="{{ $assessment->home_language }}">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent_language" class="form-label">Parent Language</label>
                        <input type="text" class="form-control" id="parent_language" name="parent_language" value="{{ $assessment->parent_language }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_name" class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="case_manager_name" name="case_manager_name" value="{{ $assessment->case_manager_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_phone" class="form-label">Member Phone</label>
                        <input type="text" class="form-control" id="case_manager_phone" name="case_manager_phone" value="{{ $assessment->case_manager_phone }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_email" class="form-label">Member email</label>
                        <input type="text" class="form-control" id="case_manager_email" name="case_manager_email" value="{{ $assessment->case_manager_email }}" required>
                    </div>
                   
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes" value="{{ $assessment->notes }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="assessment_type" class="form-label">Assessment Type</label>
                        <select class="form-select" id="assessment_type" name="assessment_type" required>
                            <option value="Initial"{{ $assessment->assessment_type == 'Initial' ? 'selected' : '' }}>Initial</option>
                            <option value="Triennial"{{ $assessment->assessment_type == 'Triennial' ? 'selected' : '' }}>Triennial</option>
                            <option value="Re-Evaluation"{{ $assessment->assessment_type == 'Re-Evaluation' ? 'selected' : '' }}>Re-Evaluation</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eld_level" class="form-label">ELD Level</label>
                        <select class="form-select" id="eld_level" name="eld_level" required>
                        <option value="1" {{ $assessment->eld_level == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $assessment->eld_level == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $assessment->eld_level == '3' ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $assessment->eld_level == '4' ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $assessment->eld_level == '5' ? 'selected' : '' }}>5</option>
                        <option value="EO" {{ $assessment->eld_level == 'EO' ? 'selected' : '' }}>EO</option>
                        <option value="RFEP" {{ $assessment->eld_level == 'RFEP' ? 'selected' : '' }}>RFEP</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_consent_received" class="form-label">Date Consent</label>
                        <input type="date" class="form-control" id="date_consent_received" name="date_consent_received" value="{{ $assessment->date_consent_received }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $assessment->due_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="anticipated_iep_date" class="form-label">Anticipated_iep Date</label>
                        <input type="date" class="form-control" id="anticipated_iep_date" name="anticipated_iep_date" value="{{ $assessment->anticipated_iep_date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" class="form-control" id="provider" name="provider" value="{{ $assessment->provider }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="assessment_areas" class="form-label">Assessment Areas</label>
                        <select class="form-select" id="assessment_areas" name="assessment_areas" required>
                            <option value="General Ability"{{ $assessment->assessment_areas == 'General Ability' ? 'selected' : '' }}>General Ability</option>
                            <option value="Social Emotional"{{ $assessment->assessment_areas == 'Social Emotional' ? 'selected' : '' }}>Social Emotional</option>
                            <option value="Adaptive Behavior"{{ $assessment->assessment_areas == 'Adaptive Behavior' ? 'selected' : '' }}>Adaptive Behavior</option>
                            <option value="Language"{{ $assessment->assessment_areas == 'Language' ? 'selected' : '' }}>Language</option>
                            <option value="ERMHS"{{ $assessment->assessment_areas == 'ERMHS' ? 'selected' : '' }}>ERMHS</option>
                            <option value="FBA"{{ $assessment->assessment_areas == 'FBA' ? 'selected' : '' }}>FBA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eligibility" class="form-label">Eligibility</label>
                        <select class="form-select" id="eligibility" name="eligibility" required>
                            <option value="Speech or Language Impairment">Speech or Language Impairment</option>
                            <option value="Intellectual Disabilit">Intellectual Disabilit</option>
                            <option value="Other Health Impairment">Other Health Impairment</option>
                            <option value="Specific Learning Disability">Specific Learning Disability</option>
                            <option value="Autism">Autism</option>
                            <option value="Emotional Disability">Emotional Disability</option>
                            <option value="Deaf-blindness">Deaf-blindness</option>
                            <option value="deafness">deafness</option>
                            <option value="hearing impairment">hearing impairment</option>
                            <option value="multiple disabilities"> multiple disabilities</option>
                            <option value="Orthopedic impairment">Orthopedic impairment</option>
                            <option value="traumatic brain injury">traumatic brain injury</option>
                            <option value="visual impairment">visual impairment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Received"{{ $assessment->status == 'Received' ? 'selected' : '' }}>Received</option>
                            <option value="Assigned"{{ $assessment->status == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="In Progress"{{ $assessment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed"{{ $assessment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Attachments Files</label>
                        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important;">Update Assessment</button>
                </form>
            </div>
        </div>
    </div>
</div>
                    @endforeach
                    <tr>
                        <!-- <td colspan="6" class="text-center">No Assessment found.</td> -->
                    </tr>
            
            </tbody>
        </table>
    </div>
    </div>
<!-- create model -->

<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assessmentModalLabel">Create Assessment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assessmentForm" action="{{ route('assessments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="primary_phone" class="form-label">Primary Phone</label>
                        <input type="text" class="form-control" id="primary_phone" name="primary_phone" required>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="alternate_phone" class="form-label">Alternate Phone</label>
                        <input type="text" class="form-control" id="alternate_phone" name="alternate_phone">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_phone" class="form-label">Emergency Phone</label>
                        <input type="text" class="form-control" id="emergency_phone" name="emergency_phone">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent_name" class="form-label">Parent Name</label>
                        <input type="text" class="form-control" id="parent_name" name="parent_name" required>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="student_language" class="form-label">Student Language</label>
                        <input type="text" class="form-control" id="student_language" name="student_language">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="home_language" class="form-label">Home Language</label>
                        <input type="text" class="form-control" id="home_language" name="home_language">
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="parent_language" class="form-label">Parent Language</label>
                        <input type="text" class="form-control" id="parent_language" name="parent_language" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_name" class="form-label">Member Name</label>
                        <input type="text" class="form-control" id="case_manager_name" name="case_manager_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_phone" class="form-label">Member Phone</label>
                        <input type="text" class="form-control" id="case_manager_phone" name="case_manager_phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_manager_email" class="form-label">Member email</label>
                        <input type="text" class="form-control" id="case_manager_email" name="case_manager_email" required>
                    </div>
                   
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes" required>
                    </div>
                    <div class="mb-3">
                        <label for="assessment_type" class="form-label">Assessment Type</label>
                        <select class="form-select" id="assessment_type" name="assessment_type" required>
                            <option value="Initial">Initial</option>
                            <option value="Triennial">Triennial</option>
                            <option value="Re-Evaluation">Re-Evaluation</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eld_level" class="form-label">ELD Level</label>
                        <select class="form-select" id="eld_level" name="eld_level" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="EO">EO</option>
                            <option value="RFEO">RFEO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date_consent_received" class="form-label">Date Consent</label>
                        <input type="date" class="form-control" id="date_consent_received" name="date_consent_received" required>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="anticipated_iep_date" class="form-label">Anticipated_iep Date</label>
                        <input type="date" class="form-control" id="anticipated_iep_date" name="anticipated_iep_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="provider" class="form-label">Provider</label>
                        <input type="text" class="form-control" id="provider" name="provider" required>
                    </div>
                    <div class="mb-3">
                        <label for="assessment_areas" class="form-label">Assessment Areas</label>
                        <select class="form-select" id="assessment_areas" name="assessment_areas" required>
                            <option value="General Ability">General Ability</option>
                            <option value="Social Emotional">Social Emotional</option>
                            <option value="Adaptive Behavior">Adaptive Behavior</option>
                            <option value="Language">Language</option>
                            <option value="ERMHS">ERMHS</option>
                            <option value="FBA">FBA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="eligibility" class="form-label">Eligibility</label>
                        <select class="form-select" id="eligibility" name="eligibility" required>
                            <option value="Speech or Language Impairment">Speech or Language Impairment</option>
                            <option value="Intellectual Disabilit">Intellectual Disabilit</option>
                            <option value="Other Health Impairment">Other Health Impairment</option>
                            <option value="Specific Learning Disability">Specific Learning Disability</option>
                            <option value="Autism">Autism</option>
                            <option value="Emotional Disability">Emotional Disability</option>
                            <option value="Deaf-blindness">Deaf-blindness</option>
                            <option value="deafness">deafness</option>
                            <option value="hearing impairment">hearing impairment</option>
                            <option value="multiple disabilities"> multiple disabilities</option>
                            <option value="Orthopedic impairment">Orthopedic impairment</option>
                            <option value="traumatic brain injury">traumatic brain injury</option>
                            <option value="visual impairment">visual impairment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Received">Received</option>
                            <option value="Assigned">Assigned</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                                <div class="mb-3">
                    <label for="attachments" class="form-label">Attachment Files</label>
                    <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                </div>

                    <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important;">Save Assessment</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function confirmDelete(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this entry!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                document.getElementById('delete-employe-form-' + id).submit();
            }
        });
    }
</script>

@if (session('success'))
<script>
    swal({
        title: "Success!",
        text: "{{ session('success') }}",
        icon: "success",
        button: "OK",
    });
</script>
@endif
@endsection

<!-- Include Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBcDLPzCoHvcLAjs8n3lATJv1z7URQk93jEN0lpR9nSM1pIP" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuWLQjQjzHKAgCf2ZxKcbhs5jqKls8Z8Ncz5e8xAHPc2JOcI9C4OP9e5ab/78N3F" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
