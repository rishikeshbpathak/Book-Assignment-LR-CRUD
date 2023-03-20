@extends('layout.app')
@section('content')
<div class="container p-5 border mt-5">
    @foreach ($BookList as $Book)
    <form method="POST" action="{{ route('BookAssign', $Book->id) }}" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="modal-body row w-50 m-auto">
            <h5 class="pb-2">Assign Book</h5>
            <div class="form-group col-md-12">
                <label>Book-Title</label>
                <input type="text" name="assign_bookId" value="{{ $Book->book_title }}" class="form-control" required
                    placeholder="">
            </div>
            <div class="form-group col-md-12">
                <label>Assig-To</label>
                <select class="form-control" name="assign_userId">
                    @foreach ($UsetList as $user )
                    @if(Auth::user()->id==$user->id)
                    <option value="{{ $user->id }}">Self</option>
                    @else
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="p-2 col-md-12 text-center">
                @if(Route::has('login'))
                @auth
                <input type="hidden" name="assign_By" value="{{ Auth::user()->id }}">
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
