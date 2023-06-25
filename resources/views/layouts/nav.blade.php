<nav class=" sticky-top navbar navbar-expand-md navbar-light bg-white shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->

                @auth

                    @can('viewAny', App\Models\Category::class)
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link"> <i class="bi bi-tags"></i>
                                Category
                                List</a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ route('users') }}" class=" nav-link"> <i class="bi bi-people-fill"></i> User List</a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}" class="nav-link"> <i class="bi bi-journal-text"></i> Blog
                            List</a>
                    </li>
                @endauth

                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            <a href="{{ route('userBlog') }}" class=" dropdown-item"> <i class="bi bi-journal-text"></i> My
                                Blogs</a>

                            @can('create', App\Models\Category::class)
                                <a href="{{ route('category.create') }}" class="dropdown-item"> <i class="bi bi-tag"></i>
                                    Create
                                    Category</a>
                            @endcan

                            <a href="{{ route('blog.create') }}" class=" dropdown-item"> <i class="bi bi-card-text"></i>
                                Create
                                Blog</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-left"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
