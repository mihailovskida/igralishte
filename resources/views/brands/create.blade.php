@extends('layouts.forms')

@section('title', 'Create')

@section('content')

<div>
  
    @if (session('success'))
        <div class="alert alert-success w-100 mt-3 mb-0 mx-auto">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="min-vh-100">
        @csrf
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('brands')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <i class="fa fa-arrow-left fa-2x me-1"></i>
                <p class="mb-0 h5 ms-2 fw-bold">Бренд</p>
            </a>
            
            <select class="form-select w-25 ms-auto p-2 ps-2 fw-bold" style="height: 34px; font-size: smaller;" id="is_active" name="is_active">
                <option selected disabled>Статус</option>
                <option value="1">Активен</option>
                <option value="0">Неактивен</option>
            </select>
        </div>
    
        <div>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Име на бренд</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Опис</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label fw-bold">Ознаки:</label>
                <input type="text" class="form-control" id="tags" name="tags"> 
                @error('tags')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="img" class="form-label fw-bold">Слики:</label>
                <div class="row justify-content-center mb-2">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-3">
                            <div class="position-relative me-2 mb-2">
                                <input type="file" class="form-control visually-hidden image" id="image_{{ $i }}" name="images[]">
                                <label for="image_{{ $i }}" class="btn me-2 d-flex justify-content-center align-items-center image-label bg-light" style="width: 57px; height: 60px;  background-color: #F5F5F5 !important;">
                                    <i class="fas image-icon" data-index="{{ $i }}"></i>
                                </label>
                            </div>
                        </div>
                    @endfor
                </div>          
            </div>

            <div class="mb-3">
                <label for="categories" class="form-label fw-bold">Категорија:</label>
                <select id="categories" class="form-select" multiple name="categories[]">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    
        <div class="fixed-bottom bg-light m-5">
            <div class="container">
                <div class="d-flex align-items-center mb-lg-5">
                    <button type="submit" class="btn btn-dark w-100">Зачувај</button>
                    <a href="{{ route('brands') }}" class="text-dark ms-3">Откажи</a>
                </div>
            </div>
        </div>
    </form>
</div>

@include('brands.icon')
@endsection
