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
        Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('customer_id'); // if you want customers from users
    $table->unsignedBigInteger('vendor_id');
    $table->unsignedBigInteger('service_id');
    $table->dateTime('booking_date');
    $table->enum('status', ['pending','accepted','declined','completed'])->default('pending');
    $table->timestamps();

    $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
