@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between m-4">
        <h3>Create Product</h3>
        <a class="btn btn-success btn-md" href="/products">List Products</a>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{ route('products.store') }}" method="POST">
    
        @csrf
        
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="product name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" placeholder="product price">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="text" name="qty" class="form-control" placeholder="product qty">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Branch</label>
                            <select name="branch_id" id="" class="form-control">
                                <option value="">Please select branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="5" placeholder="product description" class="form-control"></textarea>
        </div><br>
        <button type="submit" class="btn btn-primary m-2">Submit</button>
    </form>
</div>
@endsection