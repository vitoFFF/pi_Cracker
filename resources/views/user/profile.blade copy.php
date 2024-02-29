@extends('layouts.app')

@section('content')
<div class="container">
    <div class="navbar">
        <h1>User Profile</h1>
        <ul>
            <li><a href="#">Home</a></li>
        
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>

                <div class="card-body">
                    <!-- Your profile information goes here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
