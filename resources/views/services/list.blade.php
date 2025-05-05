
@extends('home')

@section('content')
<style>
     .form-control:focus {
    border-color: #EE2D7B !important;
    box-shadow: 0 0 5px rgba(238, 45, 123, 0.5);
}
</style>
<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #333;">Services</h1>
        <button type="button" 
                class="btn-employee" 
                style="color: white; background-color: #EE2D7B; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;"
                data-bs-toggle="modal" 
                data-bs-target="#createEmployeeModal"
                onmouseover="this.style.background=' #EE2D7B'" 
                onmouseout="this.style.background=' #EE2D7B'">
            Create Service
        </button>
    </div>
    <div class="card-datatable table-responsive text-nowrap">
        <table id='example' class="table">
            <thead>
                <th>#</th>
                <th>Student Name</th>
                <th>Service Type</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tbody>
                
                @foreach($services as $index => $service)
                        <tr>
                        <td>{{ $index + 1 }}</td>
                <td>{{ $service->student_first_name }} {{ $service->student_last_name }}</td>
                <td>{{ $service->services_type }}</td>
                <td>
                    @if($service->status == 'Received')
                        <span class="badge bg-warning text-dark">Received</span>
                    @elseif($service->status == 'Assigned')
                        <span class="badge bg-success">Assigned</span>
                    @endif
                </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                    <a class="dropdown-item" href="{{ route('service_documents.index',$service->id ) }}">
                                        <i class="fa fa-file-alt me-1"></i> Document
                                    </a>
                                   
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editAssessmentModal{{ $service->id }}">

                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </a>
                                     <!-- View Button -->
                                    <a class="dropdown-item" href="{{ route('services.show', $service->id) }}">
                                        <i class="ti ti-eye me-1"></i> View
                                    </a>
                                    
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $service->id }})">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </a>
                                        <form id="delete-employe-form-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Employee Modal -->
        <div class="modal fade" id="editAssessmentModal{{ $service->id }}" tabindex="-1" aria-labelledby="editAssessmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit Form -->
                            <form action="{{ route('services.update', $service->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="student_first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="student_first_name" value="{{ $service->student_first_name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="student_middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="student_middle_name" value="{{ $service->student_middle_name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="student_last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="student_last_name" value="{{ $service->student_last_name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_primary" class="form-label">Primary Phone</label>
                                    <input type="text" class="form-control" name="phone_primary" value="{{ $service->phone_primary }}">
                                </div>
                                <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone_alternate" class="form-label">Phone Alternate</label>
                            <input type="text" class="form-control" id="phone_alternate" name="phone_alternate" value="{{ $service->phone_alternate }}">
                        </div>

                        <div class=" col-md-6 mb-3">
                            <label for="phone_emergency" class="form-label">Phone Emergency</label>
                            <input type="text" class="form-control" id="phone_emergency" name="phone_emergency" value="{{ $service->phone_emergency }}" required>
                        </div>
                        </div>

                                <div class="mb-3">
                                    <label for="parent_name" class="form-label">Parent Name</label>
                                    <input type="text" class="form-control" name="parent_name" value="{{ $service->parent_name }}" required>
                                </div>

                                <div class="mb-3">
                            <label for="parent_phone" class="form-label">Parent Phone</label>
                            <input type="text" class="form-control" id="parent_phone" name="parent_phone" value="{{ $service->parent_phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="parent_email" class="form-label">Parent Email</label>
                            <input type="text" class="form-control" id="parent_email" name="parent_email" value="{{ $service->parent_email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="student_language" class="form-label">Student Language</label>
                            <input type="text" class="form-control" id="student_language" name="student_language" value="{{ $service->student_language }}" required>
                        </div>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_home_language" class="form-label">Student Home Language</label>
                            <input type="text" class="form-control" id="student_home_language" name="student_home_language" value="{{ $service->student_home_language }}">
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="parent_language" class="form-label">Parent Language</label>
                            <input type="text" class="form-control" id="parent_language" name="parent_language" value="{{ $service->parent_language }}" required>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="case_manager_name" class="form-label">Case Name</label>
                            <input type="text" class="form-control" id="case_manager_name" name="case_manager_name" value="{{ $service->case_manager_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="case_manager_phone" class="form-label">Case Phone</label>
                            <input type="text" class="form-control" id="case_manager_phone" name="case_manager_phone" value="{{ $service->case_manager_phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="case_manager_email" class="form-label">case Email</label>
                            <input type="text" class="form-control" id="case_manager_email" name="case_manager_email" value="{{ $service->case_manager_email }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="school_name" class="form-label">School Name</label>
                            <input type="text" class="form-control" id="school_name" name="school_name" value="{{ $service->school_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <input type="text" class="form-control" id="notes" name="notes" value="{{ $service->notes }}" required>
                        </div>


                                <div class="mb-3">
                                    <label for="services_type" class="form-label">Service Type</label>
                                    <select class="form-select" name="services_type" required>
                                        <option value="DIS Counseling" {{ $service->services_type == 'DIS Counseling' ? 'selected' : '' }}>DIS Counseling</option>
                                        <option value="Language & Speech" {{ $service->services_type == 'Language & Speech' ? 'selected' : '' }}>Language & Speech</option>
                                        <option value="ERMHS Counseling" {{ $service->services_type == 'ERMHS Counseling' ? 'selected' : '' }}>ERMHS Counseling</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="eld_level" class="form-label">ELD Level</label>
                                    <select class="form-select" name="eld_level" required>
                                        <option value="1" {{ $service->eld_level == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $service->eld_level == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $service->eld_level == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $service->eld_level == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $service->eld_level == '5' ? 'selected' : '' }}>5</option>
                                        <option value="EO" {{ $service->eld_level == 'EO' ? 'selected' : '' }}>EO</option>
                                        <option value="RFEP" {{ $service->eld_level == 'RFEP' ? 'selected' : '' }}>RFEP</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                            <label for="service_minutes" class="form-label">Service Minutes</label>
                            <input type="text" class="form-control" id="service_minutes" name="service_minutes" value="{{ $service->service_minutes }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="frequency" class="form-label">frequency</label>
                            <input type="text" class="form-control" id="frequency" name="frequency" value="{{ $service->frequency }}" required>
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
                                    <select class="form-select" name="status" required>
                                        <option value="Received" {{ $service->status == 'Received' ? 'selected' : '' }}>Received</option>
                                        <option value="Assigned" {{ $service->status == 'Assigned' ? 'selected' : '' }}>Assigned</option>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important;">Update Service</button>
                                </div>
                            </form>
                            <!-- Edit Form Ends -->
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


<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
<div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createServiceModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Starts -->
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="student_first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="student_first_name" name="student_first_name" required>
                        </div>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="student_middle_name" name="student_middle_name">
                        </div>

                        <div class=" col-md-6 mb-3">
                            <label for="student_last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="student_last_name" name="student_last_name" required>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone_primary" class="form-label">Primary Phone</label>
                            <input type="text" class="form-control" id="phone_primary" name="phone_primary">
                        </div>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone_alternate" class="form-label">Phone Alternate</label>
                            <input type="text" class="form-control" id="phone_alternate" name="phone_alternate">
                        </div>

                        <div class=" col-md-6 mb-3">
                            <label for="phone_emergency" class="form-label">Phone Emergency</label>
                            <input type="text" class="form-control" id="phone_emergency" name="phone_emergency" required>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="parent_name" class="form-label">Parent Name</label>
                            <input type="text" class="form-control" id="parent_name" name="parent_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="parent_phone" class="form-label">Parent Phone</label>
                            <input type="text" class="form-control" id="parent_phone" name="parent_phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="parent_email" class="form-label">Parent Email</label>
                            <input type="text" class="form-control" id="parent_email" name="parent_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="student_language" class="form-label">Student Language</label>
                            <input type="text" class="form-control" id="student_language" name="student_language" required>
                        </div>
                        <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_home_language" class="form-label">Student Home Language</label>
                            <input type="text" class="form-control" id="student_home_language" name="student_home_language">
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label for="parent_language" class="form-label">Parent Language</label>
                            <input type="text" class="form-control" id="parent_language" name="parent_language" required>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="case_manager_name" class="form-label">Case Name</label>
                            <input type="text" class="form-control" id="case_manager_name" name="case_manager_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="case_manager_phone" class="form-label">Case Phone</label>
                            <input type="text" class="form-control" id="case_manager_phone" name="case_manager_phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="case_manager_email" class="form-label">case Email</label>
                            <input type="text" class="form-control" id="case_manager_email" name="case_manager_email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="school_name" class="form-label">School Name</label>
                            <input type="text" class="form-control" id="school_name" name="school_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <input type="text" class="form-control" id="notes" name="notes" required>
                        </div>
                        <div class="mb-3">
                            <label for="services_type" class="form-label">Service Type</label>
                            <select class="form-select" id="services_type" name="services_type" required>
                                <option value="DIS Counseling">DIS Counseling</option>
                                <option value="Language & Speech">Language & Speech</option>
                                <option value="ERMHS Counseling">ERMHS Counseling</option>
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
                                <option value="RFEP">RFEP</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="service_minutes" class="form-label">Service Minutes</label>
                            <input type="text" class="form-control" id="service_minutes" name="service_minutes" required>
                        </div>
                        <div class="mb-3">
                            <label for="frequency" class="form-label">frequency</label>
                            <input type="text" class="form-control" id="frequency" name="frequency" required>
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
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important;">Save Service</button>
                        </div>
                    </form>
                    <!-- Form Ends -->
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




