@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4 mt-4">
                <a href="{{route('admin.index')}}" class="btn btn-primary">Back</a>
                <hr>
                <h3 class="page-title">Edit Product</h3>
                <form action="{{route('admin.update', $product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Product name</label>
                        <input required type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
                    </div>
                    <div class="form-group">
                        <label>Product image</label>
                        <div class="row">

                            <div class="col-md-12 mb-2">
                                @if(strpos($product->product_image, "https://") !== false || strpos($product->product_image, "http://") !== false)
                                    <img src="{{ $product->product_image }} " style="max-width: 100%">
                                @else
                                    <img src="{{ Storage::url($product->product_image) }}" style="max-width: 100%">
                                @endif
                            </div>
                        </div>
                        <input type="file" class="form-control-file" name="product_image">
                    </div>
                    <div class="form-group">
                        <label>Product SKU</label>
                        <input required type="number" name="product_sku" class="form-control" value="{{$product->product_sku}}">
                    </div>
                    <div class="form-group">
                        <label>Product status</label>
                        <select name="product_status" class="form-control">
                            @foreach(["disabled" => "Disabled", "enabled" => "Enabled"] AS $product_status=> $statusLabel)
                                <option value="{{ $product_status }}" {{ old("product_status", $product->product_status) == $product_status ? "selected" : "" }}>{{ $statusLabel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product price</label>
                        <input required type="number" name="product_price" class="form-control" value="{{$product->product_price}}">
                    </div>
                    <div class="form-group">
                        <label>Product special price</label>
                        <input required type="number" name="product_special_price" class="form-control" value="{{$product->product_special_price}}">
                    </div>
                    <div class="form-group">
                        <label>Product description</label>
                        <textarea class="product_description" name="product_description">{!! $product->product_description !!}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:'textarea.product_description',
            width: 900,
            height: 300
        });
    </script>
@endsection
