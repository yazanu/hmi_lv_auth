@extends('layouts.auth-master') 

@section('content')
    <form action="/registration" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="">User Name</label>
            <input type="text" name="name" id="" class="form-control" placeholder="Enter your name" value="{{old('name')}}">

            @if ($errors->has('name'))
                <span class="text-danger">
                    {{$errors->first('name')}}
                </span>
            @endif
        </div>

        <div class="form-group mb-2">
            <label for="">Email</label>
            <input type="email" class="form-control" name="email" id="" placeholder="Enter your email" value="{{old('email')}}">

            @if ($errors->has('email'))
                <span class="text-danger">
                    {{$errors->first('email')}}
                </span>
            @endif
        </div>

        <div class="form-group mb-2">
            <label for="">Password</label>
            <input type="password" name="password" id="" class="form-control" placeholder="Enter your password">

            @if ($errors->has('password'))
                <span class="text-danger">
                    {{$errors->first('password')}}
                </span>
            @endif
        </div>

        <div class="form-group mb-2">
            <label for="">Confirm Password</label>
            <input type="password" name="confirm_password" id="" class="form-control">

            @if ($errors->has('confirm_password'))
                <span class="text-danger">
                    {{$errors->first('confirm_password')}}
                </span>
            @endif
        </div>

        <a href="/" class="btn btn-md btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-md btn-primary float-end">Submit</button>
        
    </form>
@endsection