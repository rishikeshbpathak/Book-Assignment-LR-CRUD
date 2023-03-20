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
                    <td colspan="1">
                        <h4 class="pt-2">Assign-List </h4>
                    </td>
                    <td colspan="2"><input class="form-control" id="Input" type="text" placeholder="Search.."></td>
                    @if(Route::has('login'))
                    @auth
                    <td colspan="1" class="float-right">
                        <a class="btn btn-outline-success  " href="/">View-Book</a>
                    </td>
                    <td>
                        <a class="btn btn-warning " href="{{ route('logout') }}">logout</a>
                    </td>
                    @else
                    <td>
                        <a class="btn btn-warning " href="/">View Book</a>

                        @endif
                        @endauth
                    </td>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book-Title</th>
                    <th scope="col">User-Name</th>
                    <th scope="col">Assign-By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="TableData">
                @foreach ($AssignBookList as $key=>$Book)
                @if($Book->assign_status=='1')
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $Book->book->book_title}}</td>
                     <td>-</td>
                     <td>-</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('UnAssignBook' , $Book->id) }}">Un-Assign</a>
                    </td>
                </tr>
                @else
                @endif
                @endforeach

            </tbody>
        </table>
    </div>
</section>
@endsection
