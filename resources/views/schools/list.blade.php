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
    .form-control:focus {
    border-color: #EE2D7B !important;
    box-shadow: 0 0 5px rgba(238, 45, 123, 0.5);
}
</style>
<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h1 class="fs-4 fw-semibold text-dark">Schools</h1>
        <button type="button"
                class="btn"
                style="color: white; background-color: #EE2D7B;"
                data-bs-toggle="modal"
                data-bs-target="#createSchoolModal">
            Create School
        </button>
    </div>

    <div class="card-datatable table-responsive text-nowrap">
        <table id="example" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schools as $index => $school)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center">
                            <i class="ti ti-school ti-md text-primary me-2"></i>
                            <span class="fw-medium">{{ $school->name }}</span>
                        </td>
                        <td>{{ $school->contact_number }}</td>
                        <td>{{ $school->address }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editSchoolModal{{ $school->id }}">
                                        <i class="ti ti-pencil me-1"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="confirmDelete({{ $school->id }})">
                                        <i class="ti ti-trash me-1"></i> Delete
                                    </a>
                                    <form id="delete-school-form-{{ $school->id }}" action="{{ route('schools.destroy', $school->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editSchoolModal{{ $school->id }}" tabindex="-1" aria-labelledby="editSchoolModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="{{ route('schools.update', $school->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input value="{{ $school->name }}" type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input value="{{ $school->contact_number }}" type="phone" class="form-control" name="contact_number" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="Address" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Enter new address" rows="4">{{ $school->address }}</textarea>
                                        </div>
                                    </div>
                                        <div class="d-grid mt-3">
                                            <button type="submit" class="btn btn-primary" style="background-color: #EE2D7B; border: none; width: 20%;">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="4" class="text-center">No schools found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Create School Modal -->
<div class="modal fade" id="createSchoolModal" tabindex="-1" aria-labelledby="createSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('schools.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="contact_number" class="form-label">Phone</label>
                            <input type="tel" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" required>
                            @error('contact_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3" required></textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary" style="background-color: #EE2D7B; border: none; width: 20%;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Delete Confirmation -->
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
                document.getElementById('delete-school-form-' + id).submit();
            }
        });
    }
  
</script>

<!-- Success Message -->
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