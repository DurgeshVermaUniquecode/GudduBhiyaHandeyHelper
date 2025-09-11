<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT
        $table->string('name');
        $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken(); // VARCHAR(100), nullable
        $table->enum('status', ['ACTIVE', 'INACTIVE', 'DELETE'])->default('ACTIVE');
        
        $table->timestamps(); // created_at and updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
