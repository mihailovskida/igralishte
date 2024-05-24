@extends('layouts.app')

@section('title', 'Brands')

@section('content')
<div>
    @if (session('success'))
        <div class="alert alert-success mt-3 mb-0 mx-auto">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger w-100 mt-3 mb-0 mx-auto">
            <ul  class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="input-group rounded my-4 border rounded">
        <input type="search" class="form-control border-none outline-none" id="searchInput" placeholder="Пребарувај..." style="border: none !important; outline: none !important;" />
        <button class="btn border-0 rounded-0 p-0" type="submit" id="search-addon">
            <i class="fas fa-search"></i>
        </button>
        <button class="btn border-0 rounded-0 p-2" type="button" id="dropdown-addon">
            <i class="fas fa-chevron-down"></i>
        </button>
    </div>

    <div class="row justify-content-end align-items-center mb-5">
        <div class="col-auto">
            <p class="m-0" style="font-size:12px;">Додај нов бренд</p>
        </div>
        <div class="col-auto ps-0">
            <a href="{{ route('brands.create')}}" class="btn d-flex justify-content-center align-items-center" style="background-color: #8A8328; color: white; border-radius: 8px; width: 30px; height:30px;">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div>
        <p class="h5 fw-bold">Активни</p>
        <div class="mb-4">
            @foreach ($brands->where('is_active', 1) as $brand)
                <div class="brand-item border rounded mb-3" style="background-color: #FDFDFD">
                    <div class="p-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 ">{{$brand->name}}</h6>
                        <div class="d-flex">
                            <a href="{{ route('brands.edit', $brand)}}" type="button" class="btn me-2 border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" style="width: 30px; height:30px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" 
                                onclick="return confirm('Are you sure you want to delete this brand?')"                                
                                style="width: 30px; height:30px;">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="h5  text-muted fw-bold">Архива</p>
        <div>
            @foreach ($brands->where('is_active', 0) as $brand)
                <div class="border rounded mb-3" style="background-color: #FDFDFD">
                    <div class="p-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-muted">{{$brand->name}}</h6>
                        <div class="d-flex">
                            <a href="{{ route('brands.edit', $brand)}}" type="button" class="btn me-2 border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" style="width: 30px; height:30px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" 
                                onclick="return confirm('Are you sure you want to delete this brand?')"                                
                                style="width: 30px; height:30px;">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const brandItems = document.querySelectorAll('.brand-item');

    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase();

        brandItems.forEach(function(item) {
            const itemName = item.querySelector('h6').textContent.trim().toLowerCase();
            if (itemName.includes(searchText)) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });
    });
</script>
@endsection
