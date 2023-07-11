@extends('admin.layouts.base')

@section('contents')
<div class="p-5" style="margin-inline: 10rem">
    
    <h1>Edit Technology</h1>

    <form method="POST" action="{{ route('admin.technologies.update', ['technology' => $technology->id]) }}" novalidate>
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name', $technology->name) }}"
            >
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="10"
                name="description">{{ old('description', $technology->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div> 
@endsection