@extends('admin.layouts.base')

@section('contents')

{{-- *************************************************************** --}}



{{-- *************************************************************** --}}

    <button type="button" class="btn btn-primary mt-4 mx-4">
        <a href="{{ route("admin.technologies.create") }}" class="card-link text-decoration-none text-light" style="font-weight: 700; font-size:25px">Create a new Technology</a>
    </button>

    <div class="container bg-dark">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Id</th>
                    <th scope="col"><span style="padding-left: 52rem;">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->name }}</th>
                        <th scope="row">{{ $technology->id }}</th>
                        
                        <td class="d-flex justify-content-end px-4">
                            <a class="btn btn-primary mx-1" href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}">View</a>
                            <a class="btn btn-warning mx-1" href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}">Edit</a>
                            <button type="button" class="btn btn-danger js_delete mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $technology->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Modale 'Are you sure' - Delete --}}
    
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            No
                        </button>
                        <form
                        action=""
                        data-template="{{ route('admin.technologies.destroy', ['technology' => '*****']) }}"
                        method="POST"
                        class="d-inline-block"
                        id="confirm-delete"
                        >
                        @csrf
                        @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection