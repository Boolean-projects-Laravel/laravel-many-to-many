@extends('admin.layouts.base')

@section('contents')
<div class="bg-dark text-light py-2 mb-3">
    <h1 class="ms-4" style="font-weight: 700">Trash can</h1>
</div>

{{-- ********************************************************************** --}}

@if (session('delete_success'))
    @php $project = session('delete_success') @endphp
    <div class="alert alert-danger">
        The Project "{{ $project->title }}" has been permanently deleted
    </div>
@endif

{{-- ********************************************************************** --}}

<div class="container_table mx-4">

    <table class="table table-striped mt-4">
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
                <th scope="col"><span class="d-flex justify-content-center" style="padding-right: 7rem;">Actions</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trashedProjects as $project)
                <tr>
                    <th scope="row">{{ $project->title }}</th>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->author }}</td>
                    <td>{{ $project->creation_date}}</td>
                    <td>{{ $project->last_update }}</td>
                    <td>{{ $project->collaborators }}</td>
                    <td>{{ $project->description }}</td>
                    <td><a 
                        href="{{ route('admin.types.show', ['type' => $project->type]) }}"
                        >
                        {{ $project->type->name }}
                        </a>
                    </td>
                    <td>
                        {{-- <a href="">{{ implode(', ', $project->technologies->pluck('name')->all()) }}</a> --}}
                        @foreach ($project->technologies as $technology)
                            <a 
                            href="{{route('admin.technologies.show', ['technology' => $technology])}}">{{$technology->name}}</a>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </td>
                    <td><a href="{{ $project->link_github }}">Link</a></td>
                    
                    <td class="d-flex justify-content-end px-3">
                        <form
                            action=
                            "{{ route('admin.projects.restore', ['project' => $project]) }}"
                            method="post"
                            class="d-inline-block mx-1"
                        >
                            @csrf
                            <button class="btn btn-success">Restore</button>
                        </form>
                        <form
                            action="{{ route('admin.projects.harddelete', ['project' => $project->slug]) }}"
                            method="post"
                            class="d-inline-block mx-1"
                        >
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger button_delete">
                                Permanently delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>



{{ $trashedProjects->links() }}
@endsection