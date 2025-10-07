<nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">Home</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/posts') }}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item d-flex align-items-center">
                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button type="submit"
                                    class="nav-link btn btn-link text-danger p-0"
                                    style="text-decoration: none; line-height: 1.6;">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/posts') }}">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/register') }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/login') }}">Login</a>
                    </li>
                @endguest
            </ul>



        </div>
    </div>
</nav>
