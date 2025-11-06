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
        Schema::create('centers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone1')->nullable();
            $table->string('email')->nullable();
            $table->string('email1')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
<<<<<<< HEAD

=======
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
        Schema::table('centers', function (Blueprint $table) {
            //
        });
=======
        Schema::dropIfExists('centers');
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
    }
};
