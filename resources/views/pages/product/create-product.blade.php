@extends('layouts.main')

@section('body')
<div class="flex flex-col gap-10 items-center">
    <div class="w-full">
        <h1 class="text-3xl font-semibold mb-4">Create Products</h1>
    </div>
    <form method="POST" action="{{ route('products.store') }}" class="w-3/4 flex flex-col items-center gap-8">
        @csrf
        <div class="w-3/4 flex flex-col gap-3">
        <label for="product_name" class="w-full">
            Product Name
        </label>
        <input type="text" placeholder="Type here" id="product_name" name="product_name" class="input input-bordered w-full @error('product_name') input-error @enderror" autocomplete="off" value="{{ old('product_name') }}"/>
        @error('product_name')
            <p class="text-sm italic text-red-700">
                {{ $message }}
            </p>        
        @enderror
        </div>
        <div class="w-3/4 flex flex-col gap-3">
        <label for="price" class="w-full">
            Price
        </label>
        <input type="text" id="price" name="price" placeholder="Type here" class="input input-bordered w-full @error('price') input-error @enderror" autocomplete="off" value="{{ old('price') }}"/>
        @error('price')
        <p class="text-sm italic text-red-700">
            {{ $message }}
        </p>        
        @enderror
        </div>
        <div class="w-3/4 flex justify-end">
            <button class="btn btn-active btn-primary" type="submit">Create</button>
        </div>
    </form>
</div>
@endsection