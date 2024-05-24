@extends('layouts.forms')

@section('title', 'Edit')

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

<form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data" class="min-vh-100">
    @csrf
    @method('PUT') 
    <div class="d-flex align-items-center mb-5">
        <a href="{{ route('brands')}}" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="fa fa-arrow-left fa-2x me-1"></i>
            <p class="mb-0 h5 ms-2 fw-bold">Бренд</p>
        </a> 
        
        <select class="form-select w-50 ms-auto p-2 ps-2 fw-bold" style="height: 34px; font-size: smaller;" name="is_active">
            <option value="1" {{ $brand->is_active == 1 ? 'selected' : '' }}>Активен</option>
            <option value="0" {{ $brand->is_active == 0 ? 'selected' : '' }}>Неактивен</option>
        </select> 
        @error('is_active')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div>
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Име на бренд</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $brand->description }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label fw-bold">Ознаки:</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{ $brand->tags_string }}">
            @error('tags')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
       
        <div class="mb-3">
            <label for="existing_images" class="form-label fw-bold">Слики:</label>
            <div class="row justify-content-start mb-2">
                @foreach ($brand->images as $image)
                   <div class="col-3">
                        <div class="position-relative me-2 mb-2 delete-image">
                            <label for="existing_image_{{ $image->id }}" class="remove-icon">
                                <img src="{{ Storage::url($image->path) }}" alt="Image" class="img-fluid clickable-image" style="width: 57px; height: 60px;">
                                <i class="fas fa-times-circle"></i>
                            </label>
                            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                        </div>
                   </div>
                @endforeach
            </div>
        </div>
    
        <div class="mb-3">
            <label for="img" class="form-label fw-bold">Додади/Измени слики:</label>
            <div class="row justify-content-center mb-2">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-3">
                        <div class="position-relative me-2 mb-2">
                            <input type="file" class="form-control visually-hidden new-image" id="new_image_{{ $i }}" name="new_images[]" data-index="{{ $i }}">
                            <label for="new_image_{{ $i }}" class="btn me-2 d-flex justify-content-center align-items-center new-image-label" style="background-color: #F5F5F5; width: 57px; height: 60px;">
                                <i class="fas  new-image-icon" data-index="{{ $i }}"></i>
                            </label>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <div class="mb-5">
            <label for="categories" class="form-label fw-bold">Категории:</label>
            <select id="categories" class="form-select w-75 me-auto p-2 ps-3" name="categories[]" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, $brand_categories) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categories')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
    </div> 
    
    <div class="d-flex align-items-center mb-lg-5">
        <button type="submit" class="btn btn-dark w-100">Зачувај</button>
        <a href="{{ route('brands') }}" class="text-dark ms-3">Откажи</a>
    </div>
</form>

<style>
.remove-icon {
    position: relative;
    display: inline-block;
}

.remove-icon .fa-times-circle {
    position: absolute;
    top: 50%;
    right: 50%;
    transform: translate(50%, -50%);
    font-size: 30px;
    color: red;
    visibility: hidden;
    cursor: pointer;
}
.clickable-image {
    cursor: pointer;
}
.remove-icon:hover .fa-times-circle {
    visibility: visible;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var deleteImages = document.querySelectorAll('.delete-image');

        deleteImages.forEach(function(image) {
            image.addEventListener('click', function(event) {
                event.preventDefault();
                
                var confirmDelete = confirm('Are you sure you want to remove this image?');
                if (confirmDelete) {
                    this.parentNode.removeChild(this);
                }
            });
        });
    });

</script>
@include('brands.icon')
@endsection

