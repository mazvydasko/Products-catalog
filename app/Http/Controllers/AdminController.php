<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        $products = Product::orderBy('updated_at', 'desc')->get();
        return view('administrator.index', ['products' => $products]);
    }

    public function create() {

        return view('administrator.create');
    }

    public function store(ProductRequest $request) {

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->product_sku = $request->input('product_sku');
        $product->product_status = $request->input('product_status');
        $product->product_price = $request->input('product_price');
        $product->product_special_price = $request->input('product_special_price');
        $product->product_description = $request->input('product_description');
        $product->product_image = $request->input('product_description');
        if ( $request->has( 'product_image' ) ) {
            $imagePath = $request->file( 'product_image' )->store( 'products-images' );
            $product->product_image = $imagePath;
        }

        $product->save();
        session()->flash('alert-success', 'Product added!');
        return redirect(route('admin.index'));
    }

    public function edit($id) {

        $product = Product::find($id);
        return view('administrator.edit', ['product'=>$product]);
    }

    public function update(ProductRequest $request, $id) {

        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->product_sku = $request->input('product_sku');
        $product->product_status = $request->input('product_status');
        $product->product_price = $request->input('product_price');
        $product->product_special_price = $request->input('product_special_price');
        $product->product_description = $request->input('product_description');
        if ($request->has( 'product_image')) {
            $imagePath = $request->file( 'product_image' )->store( 'products-images' );
            $product->product_image = $imagePath;
        }

        $product->save();
        session()->flash('alert-success', 'Product updated!');
        return redirect(route('admin.index'));
    }

    public function destroy($id) {

        Product::findOrFail($id)->delete();
        session()->flash('alert-danger', 'Task deleted!');
        return redirect()->back();
    }

    public function destroyMany(Request $request) {

        $ids = $request->input('delete_ids');
        Product::whereIn('id',$ids)->delete();
        session()->flash('alert-danger', 'Tasks deleted!');
        return redirect()->back();
    }
}
