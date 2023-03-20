@extends('layout.app')
@section('content')

<div class="container w-50 p-5">
    @if(Session::has('error'))
    <p class="text-danger">{{ Session::get('error') }}</p>
    @endif
    @if(Session::has('success'))
    <p class="text-success">{{ Session::get('success') }}</p>
    @endif
    <form method="post" class="border p-3" action="{{ route('registration') }}">
        <h3 class="text-center">Registration</h3>
        @csrf
        @method('post')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
            @if($errors->has('name'))
            <p>{{ $errors->first('name')}}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
            @if($errors->has('email'))
            <p>{{ $errors->first('email')}}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            @if($errors->has('password'))
            <p>{{ $errors->first('password')}}</p>
            @endif
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="text" name="password_confirmation" class="form-control">

        </div>
        <div class="form-group p-3 text-center">
            <button type="submit" class="btn btn-success">Submit</button>
            <a class="btn btn-primary" href="{{ route('login') }}">login</a>
        </div>
    </form>
</div>
