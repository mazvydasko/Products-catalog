@extends('layouts.app')
@section('content')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

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
        <div class="col-sm-6">
            @if(strpos($product->product_image, "https://") !== false || strpos($product->product_image, "http://") !== false)
                <img src="{{ $product->product_image }} " style="max-width: 100%">
            @else
                <img src="{{ Storage::url($product->product_image) }}" style="max-width: 100%">
            @endif
        </div>
        <div class="col-sm-6">
            <h3>{{$product->product_name}}</h3>
            <p>Reviews: {{$product->reviewCount()}}</p>
            <input class="rating rating-loading" value="{{ $product->averageRating }}" data-size="xs" disabled="">
            <p class="mt-1">SKU: {{$product->product_sku}}</p>
            <h4 class="font-weight-light mt-1">Price: {{$product->productPrice()}} <span><del>{{$product->oldProductPrice()}}</del></span>
            </h4>
        </div>
        <div class="col-sm-12">
            <p class="mt-5">{!! $product->product_description !!}</p>
            <hr>
        </div>

        <div class="col-sm-6">
            <h4>Add review</h4>
            <form method="post" action="{{route('product.postRating')}}">
                @csrf
                <div class="rating">
                    <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5"
                           data-step="1" data-size="xs">
                    <input type="hidden" name="id" required value="{{ $product->id }}">
                </div>
                <div class="form-group">
                    <input required class="form-control" type="text" name="user_name" placeholder="Enter your name...*">
                </div>
                <div class="form-group">
                    <textarea name="comment_body" class="form-control" placeholder="Enter your comment"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Add Review"/>
                </div>
            </form>
        </div>
        @foreach($product->reviews as $review)
            <div class="col-sm-12">
                <hr>
                <div class="col-sm-6">
                    <h4>{{$review->user_name}} <small>{{$review->created_at}}</small></h4>
                </div>
                <div class="col-sm-6">
                    <input class="rating rating-loading" value="{{ $review->rate}}" data-size="xs" disabled="">
                </div>
                <div class="col-sm-12">
                    {{$review->comment_text}}
                </div>
            </div>
        @endforeach
    </div>
@endsection