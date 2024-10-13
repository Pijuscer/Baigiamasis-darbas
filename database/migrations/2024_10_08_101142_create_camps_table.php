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
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            $table->string('camp_name');
            $table->string('camp_organizer');
            $table->string('camp_address');
            $table->dateTime('camp_arrival_date');
            $table->dateTime('camp_leave_date');
            $table->string('camp_foto');
            $table->longText('camp_more_info');
            $table->integer('camp_number_of_participants');
            $table->float('camp_longitude_coordinate');
            $table->float('camp_latitude_coordinate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camps');
    }
};
