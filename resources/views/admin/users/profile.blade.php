@extends('layouts.app')

@section('content')

@if (session('update_profile_msg'))
    <div class="alert alert-success">{{session('update_profile_msg')}}</div>
@endif

<div class="container">
    <form class='mb-3' id='' action='{{route('user.profile.update', $user->id)}}' method='post'
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class='mb-3'>
            <label for='name' class='form-label'>Name</label>
            <input type='text' class='form-control @error('name') is-invalid @enderror ' name='name'
                value="{{$user->name}}" placeholder='Enter your name'>
            @error('name') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class='mb-3'>
            <label for='email' class='form-label'>Email</label>
            <input type='text' class='form-control @error('email') is-invalid @enderror ' name='email'
                value="{{$user->email}}" placeholder='Enter your email'>
            @error('email') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class='mb-3'>
            <label for='phone' class='form-label'>Phone</label>
            <input type='number' class='form-control @error('phone') is-invalid @enderror ' name='phone'
                value="{{$user->phone}}" placeholder='Enter your phone'>
            @error('phone') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class='mb-3'>
            <label for='DOB' class='form-label'>DOB</label>
            <input type='date' class='form-control @error('DOB') is-invalid @enderror ' name='DOB'
                value="{{$user->DOB}}" placeholder='Enter your DOB'>
            @error('DOB') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class='mb-3'>
            <label for='gender' class='form-label'>Gender</label>
            <input type='radio' name='gender' value="Male" @if($user->gender=="Male") checked @endif> M
            <input type='radio' name='gender' value="Female" @if($user->gender=="female") checked @endif> F
            @error('gender') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class='mb-3'>
            <img src="{{$user->profile_pic}}" alt="img not found"> <br>
            <label for='profile_pic' class='form-label'>Profile Image</label>
            <input type='file' class='form-control @error('profile_pic') is-invalid @enderror ' name='profile_pic'
                placeholder='Enter your profile_pic'>
            @error('profile_pic') <span class="text-danger">{{$message}}</span> @enderror
        </div>
        <div class='mb-3 text-center'>
            <button class='btn btn-primary' type='submit'>Submit</button>
        </div>
    </form>
</div>
@endsection