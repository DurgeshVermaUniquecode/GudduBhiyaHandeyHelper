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
    Schema::create('kycs', function (Blueprint $table) {
        $table->id(); // INT(11) AUTO_INCREMENT PRIMARY KEY
        $table->unsignedBigInteger('user_id'); // Foreign key to users
        $table->string('user_image')->nullable();

        $table->enum('id_proof_type', [
            'Adhaar Card',
            'Permanent Account Number (PAN)',
            'Election Commission Id Card',
            "Driver\'s License",
            'Birth Certificate',
            'State-issued Identification Card',
            'Student Identification Card',
            'Social Security Card',
            'Military Identification Card',
            'Passport Card',
        ])->nullable();

        $table->string('id_proof_img', 100)->nullable();
        $table->string('id_proof_no', 100)->nullable();
        $table->enum('id_proof_veryfy', ['Pending', 'Verified', 'Reject'])->default('Pending');

        $table->enum('address_proof_type', [
            'Adhaar Card',
            'Passport',
            'ARMS Licence',
            'Drivers License',
            'Election Commission Id Card',
            'Ration Card With Photo And Address, For The Person Whose Photo',
            'CGHS / ECHS Card',
            'Certificate Of Address Having Photo Issued By MP/MLA/GROUP-A Gazetted Officer In Letter Head',
            'Certificate Of Address With Photo From Govt. Recognized Educational Institutions (For Students Only)',
            'Certificate Of Photo Identity Issued By Village Panchayat Head Or Its Equivalent Authority (For Rural Areas)',
            'Address Card With Photo Issued By Deptt. Of Posts. Govt. Of India',
            'Water Bill (Not Older Than Last Three Months)',
            'Telephone Bill Of Fixed Line (Not Order Than Last Three Months)',
            'Electricity Bill (Not Older Than Last Three Months)',
            'Other'
        ])->nullable();

        $table->string('address_proof_front_img', 100)->nullable();
        $table->string('address_proof_back_img', 100)->nullable();
        $table->string('address_proof_no', 100)->nullable();
        $table->enum('address_proof_veryfy', ['Pending', 'Verified', 'Reject'])->default('Pending');

        $table->string('other_proof_img', 100)->nullable();
        $table->string('other_proof_no', 100)->nullable();
        $table->enum('other_proof_veryfy', ['Pending', 'Verified', 'Reject'])->default('Pending');

        $table->integer('other_proof_type')->nullable();
        $table->text('remarks')->nullable();

        $table->enum('status', ['Pending', 'Verified', 'Reject', 'Submitted'])->default('Pending');

        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        // Optional index (already covered by primary key, but included for compatibility)
        $table->index('id', 'USRK03_id');

        // Optional: add foreign key if users table exists
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kycs');
    }
};
