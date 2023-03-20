@extends('layout.app')
@section('content')
<div class="container p-5 border mt-5">
    @foreach ($BookList as $Book)
    <form method="POST" action="{{ route('EditBook', $Book->id) }}" enctype="multipart/form-data">
        @csrf
        @method('post')
            <div class="modal-body row">
                <div class="form-group col-md-4">
                    <label>Title</label>
                    <input type="text" name="book_title" value="{{ $Book->book_title }}" class="form-control" required placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label>Auth</label>
                    <input type="text" name="book_auth" value="{{ $Book->book_auth }}" class="form-control" placeholder="">
                </div>
                <div class="form-group col-md-4">
                    <label>Status</label>
                    <input type="text" name="book_status" value="{{ $Book->book_status }}" value="enable" class="form-control" placeholder="">
                </div>
                <div class="form-group col-md-12">
                    <label>Description</label>
                    <textarea name="book_description" class="form-control" placeholder="">{{ $Book->book_description }}</textarea>
                </div>

                <div class="p-2 col-md-12 text-center">
                    @if(Route::has('login'))
                    @auth
                    <input type="hidden" name="User_id" value="{{ Auth::user()->id }}">
                    @endauth
                    @endif
                    <input type="submit" class="btn btn-success" value="Submit">
                    <a href="/" class="btn btn-outline-danger">Back</a>
                </div>
            </div>
        </form>
    @endforeach
</div>


</div>
</div>
