@extends('layouts.forms')

@section('title', 'Create')

@section('content')

<div>
  
    @if (session('success'))
        <div class="alert alert-success w-100 mt-3 mb-0 mx-auto">
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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex align-items-center mb-5">
            <a href="{{ route('products')}}" class="d-flex align-items-center text-dark text-decoration-none">
                <i class="fa fa-arrow-left fa-2x me-1"></i>
                <p class="mb-0 h5 ms-2 fw-bold">Продукт</p>
            </a>
            
            <select class="form-select w-25 ms-auto p-2 ps-2 fw-bold" style="height: 34px; font-size: smaller;" id="is_active" name="is_active">
                <option selected disabled>Статус</option>
                <option value="1">Активен</option>
                <option value="0">Неактивен</option>
            </select>
        </div>
    
        <div>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Име на продукт</label>
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
                <label for="price" class="form-label fw-bold">Цена</label>
                <input type="text" class="form-control" id="price" name="price">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label fw-bold">Количина</label>
                <div class="input-group d-flex  align-items-center">
                    <button class="btn btn-sm btn-outline-secondary rounded-circle d-flex justify-content-center align-items-center" type="button" id="minus-btn" style="height: 18px; width:18px;">
                        <i class="fas fa-minus align-items-center d-flex justify-content-center align-items-center"></i>
                    </button>
                    <input type="hidden" id="hidden-stock" name="stock" value="1">
                    <span class="input-value">1</span>
                    <button class="btn btn-sm btn-outline-secondary rounded-circle d-flex justify-content-center align-items-center" type="button" id="plus-btn" style="height: 18px; width:18px;">
                        <i class="fas fa-plus d-flex justify-content-center align-items-center"></i>
                    </button>
                </div>
                @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                                                        
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <label for="stock" class="form-label me-2 fw-bold">Величина:</label>
                    <div class="d-flex justify-content-center align-items-center" id="size-checkboxes">
                        @foreach ($sizes as $size)
                            <input type="checkbox" hidden class="checkbox" id="size{{ $size->id }}" name="sizes[]" value="{{ $size->name }}">
                            <label for="size{{ $size->id }}" class="checkbox-label">{{ $size->name }}</label>
                        @endforeach
                        <button class="btn btn-sm btn-outline-secondary rounded-circle d-flex justify-content-center align-items-center ms-1" type="button" id="add-size-btn">
                            <i class="fa fa-plus d-flex justify-content-center align-items-center"></i>
                        </button>
                    </div>
                </div>
                @error('sizes')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>                                 

            <div class="mb-3">
                <label for="size_description" class="form-label fw-bold">Совет за величина</label>
                <textarea class="form-control" name="size_description" id="size_description" cols="30" rows="3"></textarea>
                @error('size_description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <div>
                    <label for="color" class="form-label me-2 fw-bold">Боја:</label>
                    <div id="color-container">
                        @foreach($colors as $color)
                        <label for="color{{$loop->index}}" class="color-label" style="background-color: #{{$color->name}}; width: 20px; height: 20px; border-radius:3.3px; display: inline-block; {{$loop->first ? '' : 'margin-left:10px;'}}"></label>
                            <input type="checkbox" id="color{{$loop->index}}" name="colors[]" value="{{$color->name}}" class="color-checkbox visually-hidden">
                        @endforeach
                    </div>
                </div>
            
                @error('color')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="maintenance" class="form-label fw-bold">Насоки за оджување:</label>
                <textarea class="form-control" name="maintenance" id="maintenance" cols="30" rows="3"></textarea>
                @error('maintenance')
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

            <div class="mb-4">
                <label for="img" class="form-label fw-bold">Слики:</label>
                <div class="row justify-content-center mb-2">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-3">
                            <div class="position-relative mb-2">
                                <input type="file" class="form-control visually-hidden image" id="image_{{ $i }}" name="images[]">
                                <label for="image_{{ $i }}" class="btn d-flex justify-content-center align-items-center image-label bg-light" style="width: 57px; height: 60px; background-color: #F5F5F5 !important;">
                                    <i class="fas image-icon" data-index="{{ $i }}"></i>
                                </label>
                            </div>
                        </div>
                    @endfor
                </div>
                         
            </div>

            <div class="mb-4 d-flex">
                <div class="col-6 me-3">
                    <label for="brands" class="form-label fw-bold">Бренд:</label>
                    <select id="brands" class="form-select" name="brand_id">
                        <option selected disabled>Одбери</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>

                    @error('brands')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-6">
                    <label for="product_category_id" class="form-label fw-bold">Категорија:</label>
                    <select id="product_category_id" class="form-select" name="product_category_id">
                        <option selected disabled>Одбери</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
            </div>

            {{-- <div class="row align-items-center">
                <div class="row align-items-center mb-5">
                    <div class="col-auto">
                        <p class="m-0">Додај попуст</p>
                    </div>
                    <div class="col-auto ps-0">
                        <a href="#" class="btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#discountModal" style="background-color: #8A8328; color: white; border-radius: 8px; width: 30px; height:30px;">
                            <i class="fas fa-plus d-flex justify-content-center align-items-center"></i>
                        </a>
                    </div>
                </div>
                
                <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="discountModalLabel">Select Discount</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <select class="form-select" id="discountSelect" name="discount_id" aria-label="Select Discount">
                                    <option selected disabled class="text-center">Select Discount</option>
                                        @foreach($discounts as $discount)
                                            <option value="{{ $discount->id }}">
                                                <div>
                                                    Code: {{ $discount->code }}
                                                </div>
                                            <div>------------------------------------</div>
                                                <div>
                                                    Amount: {{ $discount->amount }}%</option>
                                                </div>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    
        <div class="d-flex align-items-center mb-lg-5 my-4">
            <button class="btn btn-dark w-100">Зачувај</button>
            <a href="{{ route('products') }}" class="text-dark ms-3">Откажи</a>
        </div>
    </form>
</div>
<style>
.input-value {
    display: inline-block;
    padding: 0.375rem 0.75rem;
    margin: 0;
    line-height: 1.5;
    color: #495057;
}

.btn-sm {
    width: 16px;
    height: 16px;
    font-size: 10px;
}

.btn i {
    width: 8px;
    height: 8px;
}

.checkbox-label {
    cursor: pointer;
    text-align: center;
    height: 20px;
    width: 20px;
    border-radius: 3.3px;
    margin-right: 5px;
    color: black;
    background-color: rgba(255, 219, 219, 1);
}

.checkbox:checked + .checkbox-label {
    background-color: rgba(138, 131, 40, 1);
    color: #fff;
}
.color-label.selected {
    border: 2px solid black;
}

</style>

@include('products.javascript')
@include('brands.icon')

@endsection
