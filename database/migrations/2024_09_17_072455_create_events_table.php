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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('event_organizer');
            $table->string('event_address');
            $table->dateTime('event_date');
            $table->string('event_foto');
            $table->longText('event_more_info');
            $table->integer('event_number_of_participants');
            $table->float('event_longitude_coordinate');
            $table->float('event_latitude_coordinate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
