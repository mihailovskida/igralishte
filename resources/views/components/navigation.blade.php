<div class="row vh-100">
    <div class="mt-4 align-items-center" style="height: fit-content;">
        <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#">
                <div class="text-center mb-3 mb-md-0">
                    <img src="/storage/{{ Auth::user()->avatar }}" alt="avatar" style="width: 50px; height: 50px; background: gray; border-radius: 50%">
                </div>
            </a>
            <div class="py-2 px-3 d-none d-lg-block">
                <h5 class="mb-0">{{ Auth::user()->name}} {{ Auth::user()->surname}}</h5>
                <p class="mb-0 text-muted">{{ Auth::user()->email}}</p>
            </div>
        </div>
    </div>

    <div class="text-center text-lg-start text-muted" style="height: 50vh; margin-top: -100px;">
        <div class="">
            <a href="{{ route('products') }}" class="nav-link mb-3 d-flex align-items-center">
                <i class="fa fa-cog fa-2x col-12 col-lg-3"></i>
                <p class="d-none d-lg-block col-lg-9 mx-auto mb-0">Vintage Облека</p>
            </a>
            <a href="{{ route('discounts') }}" class="nav-link mb-3 d-flex align-items-center">
                <i class="fa fa-percent fa-2x col-12 col-lg-3"></i>
                <p class="d-none d-lg-block mx-auto col-lg-9 mb-0">Попусти / промо</p>
            </a>
            <a href="{{ route('brands') }}" class="nav-link mb-3 d-flex align-items-center">
                <i class="fa-regular fa-sun fa-2x col-12 col-lg-3"></i>
                <p class="d-none d-lg-block mx-auto col-lg-9 mb-0">Брендови</p>
            </a>
            <a href="{{ route('profile') }}" class="nav-link d-flex align-items-center">
                <i class="fa-solid fa-user-large col-12 col-lg-3 fa-2x"></i>
                <p class="d-none d-lg-block mx-auto col-lg-9 mb-0">Профил</p>
            </a>
        </div>
    </div>

    <div class="position-relative">
        <div class="mt-5 d-block d-lg-none position-absolute top-0 start-50 translate-middle-x">
            <div class="d-flex justify-content-center border-top border-3">
                <a class="text-black text-decoration-none" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt my-3 fa-2x border border-3 rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    
        <div class="mt-auto mb-2 position-fixed bottom-0 start-50 translate-middle-x d-none d-lg-block" style="width: 950px;">
            <div class="border-top border-3">
                <div class="d-flex justify-content-start ms-3">
                    <a class="text-black text-decoration-none d-flex align-items-center" href="{{ route('logout') }}" style="width: 500px;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt my-3 fa-2x"></i>
                        <p class="m-0 ms-2">Одјави се</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-link {
        padding: 12px;
        border-radius: 8px;
    }

    .nav-link:hover, .nav-link:focus {
        background-color: #FFDBDB; 
        color: black;
    }

    .nav-link.active {
        background-color: #FFDBDB;
        color: black;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".nav-link");
        const activeLink = sessionStorage.getItem("activeLink");

        // Set active link on page load
        if (activeLink) {
            navLinks.forEach(function(navLink) {
                if (navLink.getAttribute("href") === activeLink) {
                    navLink.classList.add("active");
                } else {
                    navLink.classList.remove("active");
                }
            });
        }

        // Event listener for navigation links
        navLinks.forEach(function(navLink) {
            navLink.addEventListener("click", function(event) {
                navLinks.forEach(function(link) {
                    link.classList.remove("active");
                });
                this.classList.add("active");
                sessionStorage.setItem("activeLink", this.getAttribute("href"));
            });
        });
    });
</script>


