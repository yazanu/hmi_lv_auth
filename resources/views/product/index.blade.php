@extends('layouts.app-master')

@section('content')
    <div class="container mt-5">
        <h1>Create Product</h1>
        
        @if (Gate::allows('isAdmin') || Gate::allows('isManager'))
            <a href="{{ route('products.create') }}" class="btn btn-success btn-md float-right">Create Product</a>  
        @endif
        
        @if(session()->has('success'))
            <label id="box" class="alert alert-success w-100">{{session('success')}}</label>
        @elseif(session()->has('error'))
            <label id="box" class="alert alert-danger w-100">{{session('error')}}</label>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Description</th>
                        @if (Gate::allows('isAdmin') || Gate::allows('isManager'))
                        <th scope="col">Action</th>
                        @endif
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=>$product)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->qty}}</td>
                                <td>{{$product->branch->branch_name}}</td>
                                <td>{!! $product->description !!}</td>
                                
                                @if (Gate::allows('isAdmin') || Gate::allows('isManager'))
                                <td>
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                        
                                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                        
                                        @can('isAdmin')
                                        @csrf
                                        @method('DELETE')
                          
                                        <button type="submit" class="btn btn-danger">Delete</button> 
                                        
                                        @endcan
                                        
                                        
                                    </form>
                                </td>
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{$products->links()}}
            </div>
        </div>
    </div>
@endsection