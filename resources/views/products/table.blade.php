@extends('layouts.app')

@section('title', 'Products Table')

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
    <form action="{{ route('products.table')}}">
        <div class="d-flex justify-content-end align-items-center">
            <div class="input-group rounded my-4 me-3 border rounded">
                <input  type="search" class="form-control border-none outline-none" id="searchInput" placeholder="Пребарувај..." name="q" value="{{ $q}}" style="border: none !important; outline: none !important;" />
                <button class="btn border-0 rounded-0 p-0" type="submit" id="search-addon">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn border-0 rounded-0 p-2" type="button" id="dropdown-addon">
                    <i class="fas fa-chevron-down"></i>
                </button>
            </div>
            <div class="d-flex">
                <a href="{{ route('products.table')}}" class="btn d-flex justify-content-center align-items-center border me-2" style="background-color:#FFDBDB; color: rgb(0, 0, 0); border-radius: 8px; width: 30px; height:30px;">
                    <i class="fa-solid fa-table-cells-large"></i>
                </a>
                <a href="{{ route('products')}}" class="btn d-flex justify-content-center align-items-center border" style="color:rgb(0, 0, 0)e; border-radius: 8px; width: 30px; height:30px;">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>
        </div>
    </form>
    <div class="row justify-content-end align-items-center mb-4">
        <div class="col-auto">
            <p class="m-0" style="font-size:12px;">Додај нов продукт</p>
        </div>
        <div class="col-auto ps-0">
            <a href="{{ route('products.create')}}" class="btn d-flex justify-content-center align-items-center" style="background-color: #8A8328; color: white; border-radius: 8px; width: 30px; height:30px;">
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>

    <div>
        <div class="mb-4">
            @foreach ($products->where('is_active', 1) as $product)
                <div class="border rounded mb-3">
                    <div class="p-3">
                        <div class="d-flex mb-2 justify-content-between">
                            @if ($product->stock == 0)
                                <p class="mb-0 ms-auto">Продадено</p>
                            @elseif ($product->stock >= 1)
                                <span class="text-muted me-auto">*количина {{$product->stock}}</span>
                            @endif
                        </div>
                                                       
                        <div id="carouselExampleControls{{$product->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($image->path) }}" class="d-block w-100" alt="Image">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev custom-carousel-control ms-2" type="button" data-bs-target="#carouselExampleControls{{$product->id}}" data-bs-slide="prev">
                                <svg class="carousel-control-prev-icon custom-carousel-control-icon rounded-circle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.25 8a.75.75 0 0 1 .22-.53l3.5-3.5a.75.75 0 1 1 1.06 1.06L6.06 8l2.97 2.97a.75.75 0 0 1-1.06 1.06l-3.5-3.5A.75.75 0 0 1 4.25 8z"/>
                                </svg>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next custom-carousel-control me-2" type="button" data-bs-target="#carouselExampleControls{{$product->id}}" data-bs-slide="next">
                                <svg class="carousel-control-next-icon custom-carousel-control-icon rounded-circle" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.75 8a.75.75 0 0 0-.22-.53l-3.5-3.5a.75.75 0 0 0-1.06 1.06L9.94 8l-2.97 2.97a.75.75 0 0 0 1.06 1.06l3.5-3.5a.75.75 0 0 0 .22-.53z"/>
                                </svg>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                                                                                                                       
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <h6 class="mb-0">{{ $product->name }}</h6>
                            <h6 class="mb-0" style="color: #8A8328; font-weight:700;">0{{ $product->id }}</h6>
                        </div>

                        <div class="d-flex align-items-center mb-1">
                            <p class="mb-0 me-2 text-muted" style="font-size: 11px;">Boja:</p>
                            <div class="d-flex">
                                @foreach ($product->colors as $color)
                                    <div style="width: 8px; height: 8px; background-color: #{{ $color->name }}; border-radius:1.6px" class="me-1"></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-end">
                                <p class="mb-0 me-1 text-muted" style="font-size: 11px;">Величина:</p>
                                <div class="d-flex">
                                    @foreach ($product->sizes as $size)
                                        <span style="font-size: 11px;">{{ $size->name }}, </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="align-items-center">                             
                                @if($product->discount)
                                    <p class="mb-0 me-1 text-muted" style="font-size: 11px;">Цена: {{ $product->discounted_price() }} ден.</p>
                                    <p class="mb-0 me-1 text-muted" style="font-size: 11px;"><s>Цена: {{ $product->price }} ден.</s></p>
                                @else
                                    <p class="mb-0 me-1 text-muted" style="font-size: 11px;">Цена: {{ $product->price }} ден.</p>
                                @endif
                            </div>                           
                        </div>
                    </div>
                </div>
            @endforeach
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
    .carousel-inner, .carousel, img {
    width: 188px; 
    height: 192px;
    object-fit: cover;
    border-radius: 7.33px; 
}

.custom-carousel-control {
    background-color: white;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: none;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}

.custom-carousel-control-icon {
    background-color: transparent;
    width: 15px;
    height: 15px;
    border: none;
    padding: 0;
    display: inline-block;
    color: black;
}


h6 {
    font-size: 16px;
    font-weight: 400;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

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
