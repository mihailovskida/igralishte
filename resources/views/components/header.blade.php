<nav class="navbar navbar-light bg-white">
    <div class="container">
        <div class="d-flex justify-content-center">
            <a class="" href="{{ url('#') }}">
                <div class="text-center" style="">
                    <img src="{{ asset('images/test-avatar.png') }}" alt="avatar" style="width: 50px; height: 50px; background: gray; border-radius: 50%">
                </div>
            </a>
            <div class="py-2 px-3">
                <h5 class="mb-0">Vera Pinc</h5>
                <p class="mb-0 text-muted">igralishtesk@gmail.com</p>
            </div>
        </div>

        {{-- <button class="navbar-toggler btn btn-outline-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" style="outline: none; box-shadow: none;">
            <i class="fa fa-times"></i>
        </button> --}}

        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
               
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
        
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div> --}}
    </div>
</nav>

