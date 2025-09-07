<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Change enum to add 'assigned'
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending','accepted','assigned','declined','completed') DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Rollback: remove 'assigned'
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending','accepted','declined','completed') DEFAULT 'pending'");
    }
};

