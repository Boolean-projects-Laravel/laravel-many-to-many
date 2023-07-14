<header class="bg-dark py-3">
    <div class="container">
        <h1 class="text-center text-primary">Boolean Projects Git Hub</h1>
    </div>
</header>


@php $user = Auth::user(); @endphp

<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Boolean</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item" style="font-weight:700">
                    <a class="nav-link active" aria-current="page" href="/admin">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown" style="font-weight:700">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Projects 
                    </a>
                    <ul class="dropdown-menu" style="font-weight:700">
                        <li><a class="dropdown-item" href="/admin/projects">Projects List</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/admin/projects/trashed">Trash can</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" style="font-weight:700">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Type
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/types">Types List</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/admin/types/trashed">Trash can</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown" style="font-weight:700">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Technologies
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/admin/technologies">Technologies List</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search" style="font-weight:700">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-end mx-2 my-2">
        
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mx-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-weight: 700">
                    {{$user->name}}
                </a>
                <ul class="dropdown-menu mx-2" style="min-width: 0rem;">
                    <li class="mx-2" style="width: 5rem;">
                        <a href="{{ route('admin.profile.edit') }}">Edit Profile</a>
                    </li>
                    <li class="mx-2" style="min-width: 0rem;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </li>
                    
                </ul>
            </li>
        </ul>
    
    </div>
        
   
    
</nav>