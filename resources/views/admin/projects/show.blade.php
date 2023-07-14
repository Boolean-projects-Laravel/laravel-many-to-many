@extends('admin.layouts.base')

@section('contents')
    
    
    <table class="table table-striped table-dark m-0">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Id</th>
                <th scope="col">Author</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Last Update</th>
                <th scope="col">Collaborators</th>
                <th scope="col">Description</th>
                <th scope="col">Type</th>
                <th scope="col">Link</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $project->title }}</th>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->author }}</td>
                <td>{{ $project->creation_date}}</td>
                <td>{{ $project->last_update }}</td>
                <td>{{ $project->collaborators }}</td>
                <td>{{ $project->description }}</td>
                <td>
                    <a 
                    class="text-decoration-none" 
                    href="{{ route('admin.types.show', ['type' => $project->type]) }}"
                    >
                    {{ $project->type->name }}
                    </a>
                </td>
                <td><a class="text-decoration-none" href="{{ $project->link_github }}">Link</a></td>
                
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.projects.edit', ['project' => $project]) }}">Edit</a>
                    <form
                        action="{{ route('admin.projects.destroy', ['project' => $project]) }}"
                        method="post"
                        class="d-inline-block"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="container_image w-100 d-flex justify-content-center flex-column">
        <img src="{{ asset('storage/' . $project->image) }}" alt="" class="image-fluid">
    </div>
    

@endsection