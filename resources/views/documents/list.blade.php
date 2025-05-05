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
<div class="card" style="width: 100%;">
<div class="card-header d-flex justify-content-between align-items-center">
    <h1 style="font-size: 1.5rem; font-weight: 600; color: #333;">Documents</h1>

    <div class="d-flex gap-2">
        <!-- First Button -->
        <button type="button" 
                class="btn text-white" 
                style="background-color: #EE2D7B; padding: 10px 20px; border-radius: 5px; font-size: 16px;"
                data-bs-toggle="modal" 
                data-bs-target="#createDocumentModal">
            Create Document
        </button>
    </div>
</div>
<div class="container">
<div class="row">
    @foreach($documents as $document)
        <div class="col-md-4 mb-5">
            <div class="card shadow-sm border-0 rounded-lg position-relative" style="background-color: #f8f9fa;">
                <!-- Action Icons (Edit & Delete) Top Right -->
                <div class="position-absolute top-0 end-0 p-2 d-flex gap-2">
                    <!-- Edit -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editAssessmentModal{{ $document->id }}" class="text-primary">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <!-- Delete -->
                    <a href="#" class="text-danger" onclick="confirmDelete({{ $document->id }})">
                        <i class="fas fa-trash"></i>
                    </a>
                    <form id="delete-employe-form-{{ $document->id }}" action="{{ route('documents.destroy', $document->id) }}" method="post" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                <div class="card-body p-4">
                    <h5 class="card-title text-center fw-bold">{{ $document->title }}</h5>
                    <p class="card-text text-muted mb-3" style="min-height: 60px;">{{ Str::limit($document->description, 100) }}</p>

                    <div class="d-flex justify-content-center">
                        @if($document->document)
                            <a href="{{ asset('/storage/app/' . $document->document) }}" class="btn btn-primary btn-sm" style="background-color: #EE2D7B; color: white;" target="_blank">
                           Open Document
                              </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

<!-- Edit Employee Modal -->

    <div class="modal fade" id="editAssessmentModal{{ $document->id }}" tabindex="-1" aria-labelledby="editAssessmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAssessmentModalLabel">Edit Documents</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $document->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control">{{ $document->description }}</textarea>
                        </div>

                        <div class="mb-3">
    <label>Single Document</label>
    <input type="file" name="document" class="form-control">

    @if ($document->document)
        <p class="mt-2">Already uploaded: 
            <a href="{{ Storage::url($document->document) }}" target="_blank">
                View Current Document
            </a>
        </p>
    @endif
</div>


                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
    </div>
    </div>
</div>

<!-- Professional Create Document Modal -->
<div class="modal fade" id="createDocumentModal" tabindex="-1" aria-labelledby="createDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm rounded-3">
            <div class="modal-header border-bottom-0 px-4 py-3">
                <h5 class="modal-title" id="createDocumentModalLabel">Create New Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-4">
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                    @error('assessment_id')
                        <small class="text-danger d-block mb-2">{{ $message }}</small>
                    @enderror

                    <div class="mb-3">
                        <label for="title" class="form-label text-muted">Title<span class="text-danger"> *</span></label>
                        <input type="text" id="title" name="title" class="form-control border rounded-2 shadow-none" required>
                        @error('title') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label text-muted">Description</label>
                        <textarea id="description" name="description" class="form-control border rounded-2 shadow-none" rows="3"></textarea>
                        @error('description') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="document" class="form-label text-muted">Upload Single Document</label>
                        <input type="file" id="document" name="document" class="form-control shadow-none">
                        @error('document') 
                            <small class="text-danger">{{ $message }}</small> 
                        @enderror
                    </div>


                    <div class="text-end">
                        <button type="submit" class="btn btn-dark px-4" style="border: none; background-color: #EE2D7B !important;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Upload Multiple Documents Modal -->
<div class="modal fade" id="createMultiDocumentModal" tabindex="-1" aria-labelledby="createMultiDocumentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="createMultiDocumentModalLabel">Upload Multiple Documents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('documents.store.multi') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
        <input type="hidden" name="assessment_id" value="{{ $assessment->id }}">
                    @error('assessment_id')
                        <small class="text-danger d-block mb-2">{{ $message }}</small>
                    @enderror
        <div class="mb-3">
            <label>Upload Multiple Documents</label>
            <input type="file" name="multi_documents[]" class="form-control" multiple>
            @error('multi_documents') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>

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


