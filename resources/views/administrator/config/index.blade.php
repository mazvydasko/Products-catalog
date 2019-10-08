@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.index')}}" class="btn btn-primary">Back</a>
        <hr>
        <h3 class="page-title">Basic App Configuration</h3>
        <form action="{{route('config.setTaxRate')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="tax_rate" class="col-sm-3 col-form-label">Tax rate %</label>
                <div class="col-sm-1">
                    <input type="number" class="form-control" name="tax_rate" value="{{$configParams->tax_rate}}">
                </div>
                <button type="submit" class="btn btn-success">Set Tax Rate</button>
            </div>
        </form>

        <form action="{{route('config.setGlobalDiscount')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="tax_rate" class="col-sm-3 col-form-label">Global discount</label>
                <div class="col-sm-1">
                    <input name="global_discount" type="number" class="form-control" value="{{$configParams->global_discount}}">
                </div>
                <div class="col-sm-2">
                    <select name="global_discount_type" class="form-control">
                        @foreach(["percentage" => "Percentage", "fixed" => "Fixed"] AS $discount_type => $discountLabel)
                            <option value="{{ $discount_type }}" {{ $configParams->global_discount_type == $discount_type ? "selected" : "" }}>{{ $discountLabel }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Set Discount</button>
            </div>
        </form>

        <form action="{{route('config.setTaxFlag')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="tax_rate" class="col-sm-3 col-form-label">Show prices including tax</label>
                <div class="col-sm-1">
                    <input name="tax_flag" {{($configParams->tax_flag == 1) ? 'checked' : ''}} type="checkbox" class="form-control" value="1">
                </div>
                <button type="submit" class="btn btn-success">Set Tax Flag</button>
            </div>
        </form>

    </div>
@endsection