@extends('layouts.app-master')

@section('content')
    @guest
        <div class="bg-light m-2 p-5 rounded">
            <h1>Home Page</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus vel doloremque libero repellat omnis deleniti? Laudantium error exercitationem ipsum ipsam, molestiae et suscipit voluptas aliquam nesciunt inventore quo, magnam esse!</p>
        </div>
    @endguest

    @auth
        @can('isAdmin')
            <div class="bg-light m-2 p-5 rounded">
                <h1>Home Page</h1>
                <p>You are in home page and have Admin access</p>
            </div>
        @elsecan('isManager')
            <div class="bg-light m-2 p-5 rounded">
                <h1>Home Page</h1>
                <p>You are in home page and have Manager access</p>
            </div>
        @else
            <div class="bg-light m-2 p-5 rounded">
                <h1>Home Page</h1>
                <p>You are in home page and have User access</p>``
            </div>
        @endcan
    @endauth
    
@endsection