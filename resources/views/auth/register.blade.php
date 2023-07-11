@extends('guests.layouts.base')

@section('contents')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
            type="name" 
            class="form-control" 
            id="email"  
            name="name" 
            required 
            autofocus 
            autocomplete="name"
            value="{{old('name')}}"
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
            type="email" 
            class="form-control" 
            id="email" 
            aria-describedby="emailHelp" 
            name="email" 
            required 
            autofocus 
            autocomplete="username"
            value="{{old('email')}}"
            >
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
            type="password" 
            class="form-control" 
            id="password" 
            name="password"
            required 
            autocomplete="new-password"
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password</label>
            <input 
            type="password" 
            class="form-control" 
            id="password" 
            name="password_confirmation"
            required 
            autocomplete="new-password"
            >
        </div>


        <a href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>


        <button type="submit" class="btn btn-primary">Register</button>
    </form>  
@endsection