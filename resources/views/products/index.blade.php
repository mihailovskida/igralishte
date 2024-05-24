@extends('layouts.app')

@section('title', 'Products List')

@section('content')
<div class="vh-100">
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
    <form action="{{ route('products')}}">
        <div class="d-flex justify-content-end align-items-center">
            <div class="input-group rounded my-4 me-3 border rounded">
                <input  type="search" class="form-control border-none outline-none" id="searchInput" placeholder="Пребарувај..." name="q" value="{{ $q }}" style="border: none !important; outline: none !important;" />
                <button class="btn border-0 rounded-0 p-0" type="submit" id="search-addon">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn border-0 rounded-0 p-2" type="button" id="dropdown-addon">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div class="d-flex">
                <a href="{{ route('products.table')}}" class="btn d-flex justify-content-center align-items-center border me-2" style="color: rgb(0, 0, 0); border-radius: 8px; width: 30px; height:30px;">
                    <i class="fa-solid fa-table-cells-large"></i>
                </a>
                <a href="{{ route('products')}}" class="btn d-flex justify-content-center align-items-center border" style="background-color:#FFDBDB; color:rgb(0, 0, 0)e; border-radius: 8px; width: 30px; height:30px;">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
        </div>
    </form>
    <div class="row justify-content-end align-items-center mb-5">
        <div class="col-auto">
            <p class="m-0" style="font-size:12px;">Додај нов продукт</p>
        </div>
        <div class="col-auto ps-0">
            <a href="{{ route('products.create')}}" class="btn d-flex justify-content-center align-items-center" style="background-color: #8A8328; color: white; border-radius: 8px; width: 30px; height:30px;">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div class="mb-3">
        @foreach ($products as $product)
            <div class="product-item border rounded mb-3" style="background-color: #FDFDFD">
                <div class="px-2 py-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <h6 class="mb-0" style="color: #8A8328; font-weight:700;">0{{$product->id}}</h2>
                        <h6 class="mb-0 ms-2">{{$product->name}}</h6>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('products.edit', $product)}}" type="button" class="btn me-2 border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" style="width: 30px; height:30px;">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn border border-2 rounded-circle d-flex justify-content-center align-items-center p-0" 
                            onclick="return confirm('Are you sure you want to delete this product?')"                                
                            style="width: 30px; height:30px;">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4">
            <hr style="color:rgb(129, 129, 129);" class="border border-start border-end rounded">
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            @if ($products->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                </li>
            @endif
            @php
                $currentPage = $products->currentPage();
                $lastPage = $products->lastPage();
                $start = max(1, $currentPage - 2);
                $end = min($lastPage, $start + 4);
            @endphp
    
            @for ($i = $start; $i <= $end; $i++)
                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
    
            @if ($end < $lastPage)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{{ $products->url($lastPage) }}">{{ $lastPage }}</a>
                </li>
            @endif
            @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
    
</div>

<style>
    .pagination .page-item {
        border: none;
    }

    .pagination .page-item .page-link {
        color: rgba(35, 34, 33, 1);
        background-color: transparent;
        border: none;
    }

    .pagination .page-item.active .page-link {
        color: rgba(255, 91, 41, 1);
        background-color: transparent;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
    }
</style>
@endsection
