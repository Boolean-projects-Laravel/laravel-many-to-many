@extends('admin.layouts.base')


@section('contents')

    <div class="bg-dark text-light py-2 mb-3">
        <h1 class="ms-4" style="font-weight: 700">Projects List</h1>
    </div>

    {{-- ******************************************************************** --}}

    @if (session('delete_success'))
            
    @php $project = session('delete_success') @endphp

    <div class="alert alert-danger">
        The Project '{{$project->title}}' has moved to the trash
        <form 
            action="{{ route('admin.projects.restore', ['project' => $project]) }}"
            class="d-inline-block" 
            method="POST" 
            >
            @csrf
            <button class="btn btn-warning">Ripristina</button>
        </form>
    </div>

    @endif

    @if (session('restore_success'))

    @php
        $project = session('restore_success')
    @endphp

    <div class="alert alert-success">
         The Project '{{$project->title}}' has been restored
    </div>

    @endif

    {{-- *********************************************************************** --}}

    <button type="button" class="btn btn-primary mt-4 mx-2">
        <a href="{{ route("admin.projects.create") }}" class="card-link text-decoration-none text-light" style="font-weight: 700; font-size:25px">Create a new Project</a>
    </button>

    <div class="container_table my-4">
        <table class="table table-striped table-dark mt-4">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Id</th>
                    <th scope="col">Author</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Last Update</th>
                    <th scope="col">Collaborators</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">Technology</th>
                    <th scope="col">Link</th>
                    <th scope="col"><span class="d-flex justify-content-center" style="padding-right: 7rem;">Actions</span></th>
                </tr>
            </thead>
            <tbody>

                {{-- @foreach ($projects as $project)
                    @dump($project->type)
                @endforeach
                @dd() --}}
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->title }}</th>
                        <th scope="row">{{ $project->id }}</th>
                        <td>{{ $project->author }}</td>
                        <td>{{ $project->creation_date}}</td>
                        <td>{{ $project->last_update }}</td>
                        <td>{{ $project->collaborators }}</td>
                        <td><a href="/storage/{{$project->image}}">Preview</a></td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <a 
                            href="{{ route('admin.types.show', ['type' => $project->type]) }}"
                            >
                            {{ $project->type->name }}
                            </a>
                        </td>
                        <td>
                            {{-- <a href="">{{ implode(', ', $project->technologies->pluck('name')->all()) }}</a> --}}
                            @foreach ($project->technologies as $technology)
                                <a href="{{route('admin.technologies.show', ['technology' => $technology])}}">{{$technology->name}}</a>{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </td>
                        <td>
                            <a class="text-decoration-none" href="{{ $project->link_github }}">Link</a>
                        </td>
                        <td class="d-flex justify-content-end py-3">
                            <a class="btn btn-primary mx-1" href="{{ route('admin.projects.show', ['project' => $project]) }}">View</a>
                            <a class="btn btn-warning mx-1" href="{{ route('admin.projects.edit', ['project' => $project]) }}">Edit</a>
                            <button 
                                type="button" 
                                class="btn btn-danger js_delete mx-1" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-id="{{ $project->slug }}"
                            >
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
                        data-template="{{ route('admin.projects.destroy', ['project' => '*****']) }}"
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
    
    
    <div class="px-4 d-flex flex-column justify-content-start" style="font-size:20px; font-weight: 700;">
        {{ $projects->links() }}
    </div>

    {{-- <a href="{{ asset('storage/' . $project->image) }}">Preview</a> --}}
    
@endsection