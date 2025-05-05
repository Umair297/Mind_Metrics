
@extends('home')

@section('content')
<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #333;">Users</h1>
        <button type="button" 
                class="btn-employee" 
                style="color: white; background-color: #EE2D7B; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;"
                data-bs-toggle="modal" 
                data-bs-target="#createEmployeeModal"
                onmouseover="this.style.background=' #EE2D7B'" 
                onmouseout="this.style.background=' #EE2D7B'">
            Create Users
        </button>
    </div>
    <div class="card-datatable table-responsive text-nowrap">
        <table id='example' class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->isNotEmpty())
                    @foreach ($users as $index => $user)
                        <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="d-flex align-items-center">
                            <i class="ti ti-user ti-md text-primary me-4"></i>
                                <span class="fw-medium">{{ $user->name }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                    @if($user->role == 'client')
                        <span class="badge bg-warning text-dark">Client</span>
                    @elseif($user->role == 'admin')
                        <span class="badge bg-success">Admin</span>
                    @endif
                </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editEmployeModal{{ $user->id }}">
                                            <i class="ti ti-pencil me-1"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="confirmDelete({{ $user->id }})">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </a>
                                        <form id="delete-employe-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Employee Modal -->
                        <div class="modal fade" id="editEmployeModal{{ $user->id }}" tabindex="-1" aria-labelledby="editEmployeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input value="{{ $user->name }}" type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input value="{{ $user->email }}" type="text" class="form-control" name="email" required>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Enter new password">
                                                </div>
                                            </div>
                                             <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <label for="role" class="form-label">Role</label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="client" {{ $user->role == 'client' ? 'selected' : '' }}>Client</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-grid mt-3" style="width: 20%;">
                                                <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important; width: 100%; text-align: left;">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <form enctype="multipart/form-data" action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter agent name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter agent password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                            <option value="">Select Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid mt-3" style="width: 20%;">
                        <button type="submit" class="btn btn-primary" style="border: none; background-color: #EE2D7B !important; width: 100%; text-align: left;">Submit</button>
                    </div>
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
