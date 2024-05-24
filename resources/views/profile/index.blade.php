@extends('layouts.app')

@section('title', 'Profile')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3 mb-0 mx-auto">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('profile.update', $user)}}" method="POST" class="pt-2 row" enctype="multipart/form-data">
    @csrf
    @method('PUT') 
   <div class="my-4 pt-2">
        <h3 class="fw-bold">Мој профил</h3>
   </div>
   <div class="">
        <div class="mb-2 ms-2">
            <img src="/storage/{{ Auth::user()->avatar }}" alt="User image" class="rounded-circle" style="width: 81px; height: 81px;">
        </div>
        <div class="mb-3">
            <label for="avatar" style="color: rgba(138, 131, 40, 1);" class="text-decoration-underline btn p-0">Промени слика</label>
            <input type="file" id="avatar" name="avatar" hidden>
        </div>
   </div>
    <div>
        <div class="mb-4">
            <label for="name" class="form-label fw-bold">Име</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name}}">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label fw-bold">Email адреса</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email}}">
        </div>
        <div class="mb-4">
            <label for="phone" class="form-label fw-bold">Телефонски број</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone}}">
        </div>
        <div class="mb-4">
            <a href="#" style="color: rgba(138, 131, 40, 1);" onclick="openChangePasswordModal()">Промени лозинка</a>
        
            <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered w-75 mx-auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordModalLabel">Промени лозинка</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="password" class="form-label">Нова лозинка</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Внесете ја вашата нова лозинка">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Зачувај</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="d-flex align-items-center mb-lg-5">
        <button type="submit" class="btn btn-dark w-100" style="border-radius: 10px;">Зачувај</button>
    </div>
</form>

<script>
    // Function to open the modal
    function openChangePasswordModal() {
        $('#changePasswordModal').modal('show');
    }
</script>
@endsection

