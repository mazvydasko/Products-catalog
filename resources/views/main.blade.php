@extends('layouts.app')
@section('content')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

    <div class="container">
        <div class="row">
            @foreach($products  as $product)
                <div class="col-sm-6 col-md-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{$product->product_name}}</h4>
                            @if(strpos($product->product_image, "https://") !== false || strpos($product->product_image, "http://") !== false)
                                <img src="{{ $product->product_image }} " style="max-width: 300px">
                            @else
                                <img src="{{ Storage::url($product->product_image) }}" style="max-width: 300px">
                            @endif
                            <p class="mt-1">SKU: {{$product->product_sku}}</p>
                            <input class="rating rating-loading" value="{{ $product->averageRating }}" data-size="xs" disabled="">
                            <p class="font-weight-light mt-1">Price: {{$product->productPrice()}} <span><del>{{$product->oldProductPrice()}}</del></span></p>
                            <a href="{{route('product.show', $product->id)}}" class="btn btn-primary">View product</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection