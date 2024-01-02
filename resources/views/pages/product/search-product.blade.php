@extends('layouts.main')

@section('body')
<div class="flex flex-col items-center gap-10">
    <div class="w-full">
      <h1 class="text-3xl font-semibold mb-4">Search Products</h1>
    </div>
    @if (session()->has('success'))      
    <div class="alert alert-success" id="alertSuccess">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>
        {{session('success')}}
      </span>
      <button class="btn btn-sm btn-primary" onclick="hideAlertSuccess()">Accept</button>
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-warning" id="alertSuccess">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
      <span>
        {{session('error')}}
      </span>
      <button class="btn btn-sm btn-primary" onclick="hideAlertSuccess()">Accept</button>
    </div>
    @endif
    <div class="w-[90%] flex justify-center mx-auto">
        <input type="text" placeholder="Type here" class="w-3/4 input input-bordered input-secondary" id="search" autofocus/>
    </div>
    <div class="overflow-x-auto w-[90%] mx-auto">
        <table class="table table-zebra table-lg table-pin-rows text-center">
            <!-- head -->
            <thead>
              <tr>
                <th>No.</th>
                <th>Barcode</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="productList">
            </tbody>
          </table>
        </div>
</div>

<script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                var query = $(this).val();
                var no = 1;
                if(query !== ''){
                    $.ajax({
                        url: '/search',
                        method: 'GET',
                        data: { code : query },
                        dataType: 'json',
                        success: function(data){
                            var productList = $('#productList');
                            productList.empty();
        
                            $.each(data, function(index, product){
                                productList.append(`
                                    <tr>
                                        <td>${no++}</td>
                                        <td class="flex justify-center">
                                            <img src="{{asset('storage/barcodes')}}/barcode_${product.product_code}.png" alt="">
                                        </td>
                                        <td>${product.product_name}</td>
                                        <td>${product.price}</td>
                                        <td class="flex justify-center gap-5"> 
                                            <a href="/products/${product.product_code}/edit" class="btn btn-info">
                                                Update
                                            </a>
                                        <form action="/products/${product.product_code}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error">
                                            Delete
                                        </button>
                                        </form>
                </td>
                                    </tr>
                                `);
                            });
                        }
                    });
                } else {
                    $('#search-results').empty();
                }
            });
        });
</script>
@endsection