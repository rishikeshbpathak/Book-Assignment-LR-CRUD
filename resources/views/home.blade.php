@extends('layout.app')
@section('content')
@if(Session::has('error'))
<p class="text-danger">{{ Session::get('error') }}</p>
@endif
@if(Session::has('success'))
<p class="text-success">{{ Session::get('success') }}</p>
@endif
<section id="homepage">
    <div class="table-responsive pt-2">

        <table class="table table-striped border">
            <thead>

                <tr>
                    <td colspan="3">
                        <h4 class="pt-2">Book-List </h4>
                    </td>
                    <td colspan="3"><input class="form-control" id="Input" type="text" placeholder="Search.."></td>
                    @if(Route::has('login'))
                    @auth
                    <td colspan="1" class="float-right"><button type="button" class="btn btn-outline-primary "
                            data-bs-toggle="modal" data-bs-target="#AddBookModal">
                            Add-Book
                        </button>
                        <a class="btn btn-outline-success" href="{{ route('ViewAssignList') }}">View-Assign</a>
                    </td>
                    <td>
                        <a class="btn btn-warning " href="{{ route('logout') }}">logout</a>
                    </td>
                    @else
                    <td>
                        <a class="btn btn-outline-success" href="{{ route('ViewAssignList') }}">View Assign</a>
                        <a class="btn btn-warning " href="{{ route('login') }}">login</a>

                        @endif
                        @endauth
                    </td>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Auth</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Assign</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="TableData">
                @foreach ($BookList as $key=>$Book)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $Book->book_title}}</td>
                    <td>{{ $Book->book_auth}} </td>
                    <td>{{ substr($Book->book_description,0,50)}} ...</td>
                    <td>{{ $Book->book_status}} </td>
                    <td>
                        @if(Route::has('login'))
                        @auth
                        @if($Book->book_assign=='0')
                        <a class="btn btn-sm btn-outline-warning" href="{{ route('AssignBook' , $Book->id) }}">Assign</a>
                        @else
                        <button type="button" class="btn btn-sm btn-outline-success ">Assign</button>
                        @endif
                        @else
                        <a class="btn btn-outline-warning text-dark " href="{{ route('login') }}">login</a>
                        @endif
                        @endauth
                       </td>
                    <td>{{ $Book->created_at }}</td>
                    <td>
                        <form method="post" action="{{ route('DeleteBook', $Book->id) }}">
                            @csrf
                            @method('DELETE')
                            @method('post')
                            <a class="btn btn-info" href="{{ route('viewBook' , $Book->id) }}">View
                                <sup></sup></a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</section>
@endsection
<!-- Modal -->
<div class="modal fade" id="AddBookModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="AddBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="AddBookModalLabel">New-Book </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('AddBook') }}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="modal-body row">
                    <div class="form-group col-md-4">
                        <label>Title</label>
                        <input type="text" name="book_title" class="form-control" required placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Auth</label>
                        <input type="text" name="book_auth" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Status</label>
                        <input type="text" name="book_status" value="enable" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Description</label>
                        <textarea name="book_description" class="form-control" placeholder=""></textarea>
                    </div>

                    <div class="p-2 col-md-12 text-center">
                        @if(Route::has('login'))
                        @auth
                        <input type="hidden" name="book_addby" value="{{ Auth::user()->id }}">
                        @endauth
                        @endif
                        <input type="submit" class="btn btn-success" value="Submit">
                        <a href="/" class="btn btn-outline-danger">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
