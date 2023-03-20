<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\AssignBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class HomeApiController extends Controller
{
    //-----------------------View-Book----------------------//
    public function index()
    {
        $BookList = Book::orderBy('id', 'ASC')->get();

        return response()->json([
            'message'=>'Data Get Successfully',
            'Status'=>'success',
            'data'=>$BookList
        ]);
    }
    public function UserList()
    {
        $UserList = User::orderBy('id', 'ASC')->get();
        return response()->json([
            'message'=>'Data Get Successfully',
            'Status'=>'success',
            'data'=>$UserList
        ]);
    }

        //-----------------------Add-Book----------------------//
      public function AddBook(Request $request)
      {
          $request->validate([
              'book_title' => 'required',
              'book_auth' => 'required'
          ]);
          $Book = new Book();
          $Book->book_title = $request->book_title;
          $Book->book_auth = $request->book_auth;
          $Book->book_status = $request->book_status;
          $Book->book_description = $request->book_description;
          $Book->book_addby = $request->book_addby;
          $Book->book_assign ='0';
          $Book->save();
          return response()->json([
            'message'=>'Data Added Successfully',
            'Status'=>'success',
            'data'=>$Book
            ]);
      }
        //-----------------------View-Book-By-ID---------------------//
    public function viewBook(Request $request, $id)
    {
        $BookList = Book::where('id', $id)->get();
        return response()->json([
            'message'=>'Data Get Successfully By Book-Id',
            'Status'=>'success',
            'data'=>$BookList
        ]);
    }

        //-----------------------Edit-Book----------------------//

    public function EditBook(Request $request, $id)
    {
        $request->validate([
            'book_title' => 'required',
            'book_auth' => 'required',
            'book_description' => 'required'
        ]);
        $Book = Book::find($id);
        $Book->book_title = $request->book_title;
        $Book->book_auth = $request->book_auth;
        $Book->book_status = $request->book_status;
        $Book->book_description = $request->book_description;
        $Book->book_addby = $request->book_addby;
        $Book->save();
        return response()->json([
            'message'=>'Data Updated Successfully',
            'Status'=>'success',
            'data'=>$Book
        ]);
    }

        //-----------------------Delete-Book----------------------//
    public function DeleteBook(Request $request, $id)
    {
        $eventList = Book::find($id);
        $eventList->delete();
        return response()->json([
            'message'=>'Data Delete Successfully',
            'Status'=>'success',
            'data'=>$eventList
        ]);
    }

        //-----------------------Book-Assign---------------------//

        public function BookAssign(Request $request)
        {
            $request->validate([
                'book_id' => 'required',
                'user_Id' => 'required'
            ]);
            $Book = Book::find($request->book_id);
            $Book->book_assign ='1';
            $Book->save();

                $AssignBook = new AssignBook();
                $AssignBook->assign_bookId = $request->book_id;
                $AssignBook->assign_userId = $request->user_Id;
                $AssignBook->assign_By = '0';
                $AssignBook->assign_status = '1';
                $AssignBook->save();

            return response()->json([
                'message'=>'Book Assign Successfully',
                'Status'=>'success',
                'Data'=>$AssignBook
            ]);
        }
        //-----------------------Book-UN-Assign---------------------//
        public function UnAssignBook(Request $request, $id)
        {
            $AssignBookList = AssignBook::find($id);
            $book_id=$AssignBookList->assign_bookId;
            $AssignBookList->assign_status ='0';
            $AssignBookList->save();
            $Book = Book::find($book_id);
            $Book->book_assign ='0';
            $Book->save();
            return response()->json([
                'message'=>'Book Un-Assign Successfully',
                'Status'=>'success',
                'data'=>$Book
            ]);
        }
        //-----------------------Book-UN-Assign---------------------//
        public function assingList()
        {
            // $AssignBookList = AssignBook::select(
            //     "users.*")
            // ->join("Book", "Book.id", "=", "AssignBook.assign_bookId")
            // ->get();
            //  $AssignBookList=DB::table('AssignBook')->join('Book','AssignBook.assign_bookId',"=",'Book.id')->get();
       $AssignBookList = AssignBook::where('assign_status','1')->orderBy('id', 'ASC')->get();
            // foreach ($AssignBookList as $asBook)
            // {
            //     $book = Book::where('id',$asBook->assign_bookId)->get();
            // }
            // array_push($AssignBookData,$AssignBookList,$book);
             return response()->json([
                'message'=>'assing Data Successfully',
                'Status'=>'success',
                'data'=>$AssignBookList
            ]);
            // $AssignBookData=[];
            // $AssignBookList = AssignBook::orderBy('id', 'ASC')->get();
            // foreach ($AssignBookList as $asBook)
            // {
            //     $book = Book::where('id',$asBook->assign_bookId)->get();
            // }
            // array_push($AssignBookData,$AssignBookList,$book);
            // return response()->json([
            //     'message'=>'assing Data Successfully',
            //     'Status'=>'success',
            //     'data'=>$book,$AssignBookData
            // ]);
        }
}
