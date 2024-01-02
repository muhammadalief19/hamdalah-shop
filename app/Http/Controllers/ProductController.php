<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Products";
        $products = DB::table('products')->paginate(5);
        $no = 1;
        return view('pages.products', compact([
            'title', 'products', 'no'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Products";
        return view('pages.product.create-product', compact([
            'title'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric'
        ],
        [
            'product_name.required' => 'Nama Produk Wajib Diisi',
            'price.required' => 'Harga Produk Wajib diisi',
            'price.numeric' => 'Harga Produk harus berupa angka'
        ]
        );

        // product code generate
        $productCode = mt_rand(1000000000, 9999999999);
        $barcode = DNS1D::getBarcodePNG($productCode, 'C39');

        // Save barcode image to storage
        $filename = "barcode_{$productCode}.png";
        Storage::disk('public')->put("barcodes/$filename",base64_decode($barcode));

        // create product
        Product::create([
            "product_code" => $productCode,
            "product_name" => $request->product_name,
            "price" => $request->price
        ]);

        return redirect()->route('products.index')->with([
            "success" => "Product Berhasil Ditambahkan"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Products";
        $product = DB::table('products')->where('product_code', $id)->first();

        return view('pages.product.update-product', compact([
            'product', 'title'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validation
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric'
        ],
        [
            'product_name.required' => 'Nama Produk Wajib Diisi',
            'price.required' => 'Harga Produk Wajib diisi',
            'price.numeric' => 'Harga Produk harus berupa angka'
        ]
        );

        $product = DB::table('products')->where('product_code', $id);

        $updateProduct = $product->update([
            "product_name" => $request->product_name,
            "price" => $request->price
        ]);

        if ($updateProduct) {
            return redirect()->route('products.index')->with([
                "success" => "Product Berhasil Diupdate"
            ]);
        } else {
            return redirect()->route('products.index')->with([
                "error" => "Product gagal Diupdate"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('product_code', $id);
        $prod = DB::table('products')->where('product_code', $id)->first();

        // deleted barcode image
        Storage::delete("public/barcodes/barcode_{$prod->product_code}.png");

        $deleteProduct = $product->delete();

        if ($deleteProduct) {
            return redirect()->route('products.index')->with([
                "success" => "Product Berhasil Didelete"
            ]);
        } else {
            return redirect()->route('products.index')->with([
                "error" => "Product gagal Didelete"
            ]);
        }
    }

    public function showProduct() {
        $title = "Search";
        return view('pages.product.search-product', compact([
            'title'
        ]));
    }

    public function searchProduct(Request $request) {
        $query = $request->input('code');

        $product = DB::table('products')->where('product_code', 'LIKE', "%$query%")->first();

        return response()->json([
            "product" => $product,
        ]);
    }
}
