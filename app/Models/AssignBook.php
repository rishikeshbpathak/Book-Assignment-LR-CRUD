<?php

namespace App\Models;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignBook extends Model
{
    use HasFactory;
    public function User()
    {
        return $this->belongsTo(User::class,'assign_userId');
    }
    public function Userby()
    {
        return $this->belongsTo(User::class,'assign_By');
    }
    public function Book()
    {
        return $this->belongsTo(Book::class,'assign_bookId');
    }
}
