@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h3 class="page-title">All Products</h3>
                <a href="{{route('admin.create')}}" class="btn btn-primary mb-5 mt-2">Create new product</a>
                <a href="{{route('config.index')}}" class="btn btn-dark mb-5 mt-2 float-right">Configuration</a>
                <div class="panel-body">
                    <form action="{{route('admin.deletemany')}}" method="post">
                        @csrf
                        @method('delete')
                        <table class="table table-bordered table-striped datatable text-center">
                            <thead>
                            <tr >
                                <th></th>
                                <th class="align-middle">Product name</th>
                                <th>Product SKU</th>
                                <th>Product status</th>
                                <th>Product base price</th>
                                <th>Product special price</th>
                                <th>Rate avg. (reviews)</th>
                                <th class="align-middle">Edit</th>
                                <th class="align-middle">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><input type="checkbox" value="{{$product->id}}" name="delete_ids[]"></td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_sku}}</td>
                                    <td>{{$product->product_status}}</td>
                                    <td>{{$product->product_price}}</td>
                                    <td>
                                        @if($product->product_special_price)
                                            {{$product->product_special_price}}
                                        @else
                                            Not Set
                                        @endif
                                    </td>
                                    <td>{{round($product->averageRating, 1)}} ({{$product->reviewCount()}})</td>
                                    <td>
                                        <a href="{{route('admin.edit', $product->id)}}"
                                           class="btn btn-xs btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.delete', $product->id)}}" class="btn btn-xs btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger">Delete Selected</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection