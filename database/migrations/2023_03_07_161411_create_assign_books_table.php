<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_books', function (Blueprint $table) {
            $table->id();
            $table->string('assign_bookId')->nullable();
            $table->string('assign_userId')->nullable();
            $table->string('assign_By');
            $table->enum('assign_status',['0','1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_books');
    }
};
