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
        Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('vendor_id'); // each employee belongs to a vendor
    $table->string('name');
    $table->string('email')->unique();
    $table->string('phone')->nullable();
    $table->string('role')->nullable(); // e.g., plumber, electrician
    $table->enum('status', ['active','inactive'])->default('active');
    $table->timestamps();

    $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
