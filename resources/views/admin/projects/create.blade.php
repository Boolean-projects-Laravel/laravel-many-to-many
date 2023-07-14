@extends('admin.layouts.base')

@section('contents')
<div class="p-5" style="margin-inline: 10rem">
    <h1>Create a new Project</h1>
    <form 
    method="POST" 
    action="{{ route('admin.projects.store') }}" 
    enctype="multipart/form-data"  
    novalidate
    >
        {{-- Per protezione dati --}}
        @csrf 
        {{-- Per protezione dati --}}

        <div class="mb-3">
            <label 
            for="title" class="form-label" style="font-weight:700; font-size:20px">
                Title
            </label>
            <input 
            type="text" 
            class="form-control @error('title') is-invalid @enderror" 
            id="title" 
            name="title" 
            value="{{ old('title')}}">

            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label" style="font-weight:700; font-size:20px">
                Author
            </label>
            <input 
            type="text" 
            class="form-control @error('author') is-invalid @enderror" 
            id="author" 
            name="author" 
            value="{{ old('author')}}">

            <div class="invalid-feedback">
                @error('author') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label" style="font-weight:700; font-size:20px">
                Creation Date
            </label>
            <input 
            type="date" 
            class="form-control @error('creation_date') is-invalid @enderror" 
            id="creation_date" 
            name="creation_date" 
            value="{{ old('creation_date')}}">
            <div class="invalid-feedback">
                @error('creation_date') {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="last_update" class="form-label" style="font-weight:700; font-size:20px">
                Last Update
            </label>
            <input 
            type="date" 
            class="form-control @error('last_update') is-invalid @enderror" 
            id="last_update" 
            name="last_update" 
            value="{{ old('last_update')}}">
            <div class="invalid-feedback">
                @error('last_update') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="collaborators" class="form-label" style="font-weight:700; font-size:20px">
                Collaborators
            </label>
            <input 
            type="text" 
            class="form-control @error('collaborators') is-invalid @enderror" 
            id="collaborators" name="collaborators" value="{{ old('collaborators')}}">

            <div class="invalid-feedback">
                @error('collaborators') {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="image" class="form-label"style="font-weight:700; font-size:20px">
                Image
            </label>
            <div class="input-group mb-3">
                <input type="file" 
                class="form-control @error('image') is-invalid @enderror" 
                id="image" name="image" accept="image/*">
                <label class="input-group-text" for="image">
                    Upload
                </label>
            </div>
            <div class="invalid-feedback">
                @error('image') {{ $message }} @enderror
            </div>
        </div>
        

        <div class="mb-3">
            <label for="description" class="form-label"style="font-weight:700; font-size:20px">
                Description
            </label>
            <textarea 
            class="form-control @error('description') is-invalid @enderror" 
            id="description" 
            name="description" 
            value="{{ old('description')}}" 
            rows="3" 
            >{{ old('description') }}
            </textarea>

            <div class="invalid-feedback">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

    
        <div class="mb-3">
            <label for="type" class="form-label">
                Type
            </label>
            <select 
            class="form-select 
            @error('type_id') is-invalid @enderror" 
            id="type" 
            name="type_id">
                <option selected>
                    Change type
                </option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('type_id') {{ $message }} @enderror
            </div>
        </div>


        <div class="mb-3">
            <h3>Technologies</h3>
            @foreach($technologies as $technology)
                <div class="mb-3 form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="technology{{ $technology->id }}"
                        name="technologies[]"
                        value="{{ $technology->id }}"
                        @if (in_array($technology->id, old('technologies') ?: [])) checked @endif
                    >
                    <label class="form-check-label" for="technology{{ $technology->id }}">{{ $technology->name }}</label>
                    
                </div>
            @endforeach

            {{-- @dump($errors->get('tags.*')) --}}
            {{-- @error('tags')
                <div class="">
                    {{ $message }}
                </div>
            @enderror --}}
        </div>


        <div class="mb-3">
            <label for="link_github" class="form-label"style="font-weight:700; font-size:20px">
                Link
            </label>
            <input 
            type="url" 
            class="form-control @error('link_github') is-invalid @enderror" 
            id="link_github" 
            name="link_github" 
            value="{{ old('link_github')}}">

            <div class="invalid-feedback">
                @error('link_github') {{ $message }} @enderror
            </div>
        </div>

        <button class="btn btn-primary" style="font-size: 20px">Create</button>
    </form>
</div>
    
@endsection