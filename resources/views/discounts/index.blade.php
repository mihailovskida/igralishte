@extends('layouts.app')

@section('title', 'Discount')

@section('content')
<div>
    @if (session('success'))
        <div class="alert alert-success mt-3 mb-0 mx-auto">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-3 mb-0 mx-auto">
            {{ session('error') }}
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
    <form action="{{ route('discounts')}}">
        <div class="input-group rounded my-4 border rounded">
            <input  type="search" class="form-control border-none outline-none" id="searchInput" placeholder="Пребарувај..." name="q" value="{{ $q }}" style="border: none !important; outline: none !important;" />
            <button class="btn border-0 rounded-0 p-0" type="submit" id="search-addon">
                <i class="fas fa-search"></i>
            </button>
            <button class="btn border-0 rounded-0 p-2" type="button" id="dropdown-addon">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    </form>
    <div class="d-flex justify-content-end align-items-center mb-5">
        <div class="col-auto">
            <p class="m-0 text-muted" style="font-size:12px;">Додај нов попуст/промо код</p>
        </div>
        <div class="col-auto ps-2">
            <a href="{{ route('discounts.create')}}" class="btn d-flex justify-content-center align-items-center" style="background-color: #8A8328; color: white; border-radius: 8px; width: 30px; height:30px;">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div>
        <p class="h5 fw-bold">Активни</p>
        <div class="mb-4">
            @foreach ($discounts->where('is_active', 1) as $discount)
                <div class="discount-item border rounded mb-3" style="background-color: #FDFDFD">
                    <div class="p-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">{{$discount->code}}</h6>
                        <div class="d-flex">
                            <a href="{{ route('discounts.edit', $discount)}}" type="button" class="btn me-2 border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" style="width: 30px; height:30px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('discounts.destroy', $discount) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" 
                                onclick="return confirm('Are you sure you want to delete this discount?')"                                
                                style="width: 30px; height:30px;">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="h5 fw-bold text-muted">Архива</p>
        <div>
            @foreach ($discounts->where('is_active', 0) as $discount)
                <div class="border rounded mb-3" style="background-color: #FDFDFD">
                    <div class="p-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-muted">{{$discount->code}}</h6>
                        <div class="d-flex">
                            <a href="{{ route('discounts.edit', $discount)}}" type="button" class="btn me-2 border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" style="width: 30px; height:30px;">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('discounts.destroy', $discount) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" 
                                onclick="return confirm('Are you sure you want to delete this discount?')"                                
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

{{-- <script>
    const searchInput = document.getElementById('searchInput');
    const discountItem = document.querySelectorAll('.discount-item');

    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase();

        discountItem.forEach(function(item) {
            const itemName = item.querySelector('h6').textContent.trim().toLowerCase();
            if (itemName.includes(searchText)) {
                item.classList.remove('d-none');
            } else {
                item.classList.add('d-none');
            }
        });
    });
</script> --}}
@endsection
