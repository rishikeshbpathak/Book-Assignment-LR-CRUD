<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\AssignBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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



       //----------------------View-Book-To-Assign---------------------//
       public function AssignBook(Request $request, $id)
       {
           $BookList = Book::where('id', $id)->get();
           $UsetList = User::orderBy('id', 'ASC')->get();

           return response()->json([
            'message'=>'Data Delete Successfully',
            'Status'=>'success',
            'data'=>$BookList,
            'Userdata'=>$UsetList
        ]);
       }


       //----------------------View-Assign-Book----------------------//
       public function ViewAssignList()
       {
           $AssignBookList = AssignBook::orderBy('id', 'ASC')->get();
           return response()->json([
            'message'=>'View Assign Book Successfully',
            'Status'=>'success',
            'data'=>$AssignBookList
        ]);
       }
       //----------------------Add-Assign-Book---------------------//

       public function BookAssign(Request $request, $id)
       {
           $Book = Book::find($id);
           $Book->book_assign ='1';
           $Book->save();
           $BookAssign = AssignBook::where('assign_userId', $request->assign_userId)->where('assign_bookId', $id)->first();
           if (isset($BookAssign)) {
               $BookAssign->assign_status = '1';
               $BookAssign->assign_By = $request->assign_By;
               $BookAssign->save();
           } else {
               $AssignBook = new AssignBook();
               $AssignBook->assign_bookId = $request->id;
               $AssignBook->assign_userId = $request->assign_userId;
               $AssignBook->assign_By = $request->assign_By;
               $AssignBook->assign_status = '1';
               $AssignBook->save();
           }
           return redirect('home');
       }
   //----------------------UN-Assign-Book----------------------//
   public function UnAssignBook(Request $request, $id)
   {
       $AssignBookList = AssignBook::find($id);
       $book_id=$AssignBookList->assign_bookId;
       $AssignBookList->assign_status ='0';
       $AssignBookList->save();
       $Book = Book::find($book_id);
       $Book->book_assign ='0';
       $Book->save();
       return redirect('home');
   }





        //-----------------------Book-Assign---------------------//

        public function BookAssign1(Request $request, $id)
        {
            $Book = Book::find($id);
            $Book->book_assign ='1';
            $Book->save();
            return response()->json([
                'message'=>'Book Assign Successfully',
                'Status'=>'success',
                'data'=>$Book
            ]);
        }
        //-----------------------Book-UN-Assign---------------------//
        public function UnAssignBook11(Request $request, $id)
        {
            $Book = Book::find($id);
            $Book->book_assign ='0';
            $Book->save();
            return response()->json([
                'message'=>'Book Un-Assign Successfully',
                'Status'=>'success',
                'data'=>$Book
            ]);
        }
}
