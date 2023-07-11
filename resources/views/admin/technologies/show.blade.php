@extends('admin.layouts.base')

@section('contents')
<div class="container_table">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Id</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $technology->name }}</th>
                <th scope="row">{{ $technology->id }}</th>
                <td scope="row">{{ $technology->description }}</td>
            </tr>
        </tbody>
    </table>
</div>
{{-- <div class="py-2 px-2">
    <h5>Latest Project in this Type</h5>
    <ul>
        @foreach ($type->projects as $project)
            <li><a href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
        @endforeach
    </ul>
</div> --}}


@endsection