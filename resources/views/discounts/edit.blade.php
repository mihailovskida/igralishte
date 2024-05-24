@extends('layouts.forms')

@section('title', 'Edit')

@section('content')

@if (session('success'))
    <div class="alert alert-success mt-3 mb-0 mx-auto">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('discounts.update', $discount) }}" method="POST" class="min-vh-100">
    @csrf
    @method('PUT') 
    <div class="d-flex align-items-center mb-5">
        <a href="{{ route('discounts') }}" class="d-flex align-items-center text-dark text-decoration-none">
            <i class="fa fa-arrow-left fa-2x me-1"></i>
            <p class="mb-0 h5 ms-2 fw-bold">Попуст/Промо код</p>
        </a>
    
        <select class="form-select w-25 ms-auto p-2 ps-2 fw-bold" style="height: 34px; font-size: smaller;" id="is_active" name="is_active">
            <option value="1" {{ $discount->is_active == 1 ? 'selected' : '' }}>Активен</option>
            <option value="0" {{ $discount->is_active == 0 ? 'selected' : '' }}>Неактивен</option>
        </select>
    
        @error('is_active')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    
    <div>
        <div class="mb-3">
            <label for="code" class="form-label fw-bold">Име на попуст / промо код</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $discount->code }}">
            @error('code')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label fw-bold">Попуст (%)</label>
            <input class="form-control" id="amount" name="amount" value="{{ $discount->amount }}"></input>
            @error('amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            
        </div>

        <div class="mb-3">
            <label for="category" class="form-label fw-bold">Категорија:</label>
            <select id="category" class="form-select form-select-lg w-75 me-auto p-2 ps-3" name="discount_category_id" style="height: 34px; font-size: smaller;" >
                <option selected disabled>Одбери</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $discount->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        
            @error('discount_category_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        
        <div class="mb-5">
            <label for="products" class="form-label fw-bold">Постави попуст на:</label>
            <input type="text" class="form-control mb-2" id="productSearch" placeholder="Пребарај продукт">
            <select id="products" class="form-select" name="products[]" multiple>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ in_array($product->id, $selectedProductIds) ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            
        
            @error('products')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div> 
    

    <div class="fixed-bottom bg-light m-5">
        <div class="container">
            <div class="d-flex align-items-center mb-lg-5">
                <button type="submit" class="btn btn-dark w-100">Зачувај</button>
                <a href="{{ route('discounts') }}" class="text-dark ms-3">Откажи</a>
            </div>
        </div>
    </div>
    
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('productSearch');
        const selectElement = document.getElementById('products');
        const options = Array.from(selectElement.options);
        let selectedOptions = [];

        selectElement.addEventListener('change', function() {
            selectedOptions = Array.from(this.selectedOptions).map(option => option.value);
        });

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();
            const filteredOptions = options.filter(option => {
                const firstWord = option.textContent.trim().toLowerCase().split(' ')[0];
                return firstWord.startsWith(searchTerm);
            });
            selectElement.innerHTML = '';
            filteredOptions.forEach(option => {
                selectElement.appendChild(option);
                if (selectedOptions.includes(option.value)) {
                    option.selected = true;
                }
            });
        });
    });
</script>
@endsection

