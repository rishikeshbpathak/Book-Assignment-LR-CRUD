@extends('layout.app')
@section('content')
<section id="hero1">
    <div class="pt-5 mt-5 mb-5">
        <div class="container">
            <form class="w-50 bg-light m-md-auto card p-3" method="post" action="{{ route('login') }}">
                <h3 class="text-center">Login-Panel</h3>
                @if(Session::has('error'))
                <p class="text-danger">{{ Session::get('error') }}</p>
                @endif
                @if(Session::has('success'))
                <p class="text-success">{{ Session::get('success') }}</p>
                @endif
                @csrf
                @method('post')
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
                <div class="form-group p-3 text-center">
                    <button type="submit" class="btn btn-dark">login</button>
                    <a class="btn btn-outline-primary " href="{{ route('registration') }}"> New Account</a>
                </div>
            </form>
        </div>
    </div>
</section>
        @endsection


