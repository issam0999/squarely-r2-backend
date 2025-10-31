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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5);
            $table->string('name', 100);
            $table->timestamps();
        });
         // Insert default data into the 'countries' table
        DB::table('users')::table('currencies')->insert([
            ['name' => 'United States', 'code' => 'USA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Canada', 'code' => 'CAN', 'created_at' => now(), 'updated_at' => now()],
            // ... more countries
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
