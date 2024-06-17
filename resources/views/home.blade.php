@extends('layouts.app')

@section('content')
<div class="card col-6 h-100">
    <div class="text-center p-3">
        <img src="{{auth()->user()->profile_pic}}" class="rounded-circle" width="250px" alt="Img not found">
        <div class="card-body">
            <h2>Name : {{auth()->user()->name}}</h2>
            <h4>Email : {{auth()->user()->email}}</h4>
            <h4>Phone : {{auth()->user()->phone}}</h4>
            <h4>Gender : {{auth()->user()->gender}}</h4>
            <h4>DOB : {{auth()->user()->DOB}}</h4>
        </div>
        <form action="{{route('users.profile', auth()->user())}}" class="mb-3" method="GET">
            <button type="Submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>

@if (auth()->user()->role == 'admin')


    <div>

        @if (session('create_location_msg'))
            <div class="alert alert-success">{{session('create_location_msg')}}</div>
        @elseif(session('create_examCenter_msg'))
            <div class="alert alert-success">{{session('create_examCenter_msg')}}</div>
        @endif
        <div class="text-center my-2">
            <form action="{{route('location.store')}}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Add Locations">
                <button class="btn btn-primary">Add</button>
            </form>
        </div>
        <div class="text-center my-2">
            <form action="{{route('examCenter.store')}}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Add Exam Centers">
                <button class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endif
@endsection