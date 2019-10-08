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
                <h3 class="page-title">Create Product</h3>
                <form action="{{route('admin.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Product name</label>
                        <input required type="text" name="product_name" class="form-control" placeholder="Product name">
                    </div>
                    <div class="form-group">
                        <label>Product SKU</label>
                        <input required type="number" name="product_sku" class="form-control" placeholder="Product SKU" value="{{old('product_name')}}">
                    </div>
                    <div class="form-group">
                        <label>Product image</label>
                        <input type="file" class="form-control-file" name="product_image">
                    </div>
                    <div class="form-group">
                        <label>Product status</label>
                        <select name="product_status" class="form-control">
                                <option selected value="disabled">Disabled</option>
                                <option value="enabled">Enabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product price</label>
                        <input required type="number" name="product_price" class="form-control" placeholder="Product price" value="{{old('product_price')}}">
                    </div>
                    <div class="form-group">
                        <label>Product special price</label>
                        <input required type="number" name="product_special_price" class="form-control" placeholder="Product special price" value="{{old('product_special_price')}}">
                    </div>
                    <div class="form-group">
                        <label>Product description</label>
                        <textarea class="product_description" name="product_description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
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
