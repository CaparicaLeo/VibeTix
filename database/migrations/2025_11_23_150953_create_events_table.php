<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('gen_random_uuid()'))->primary();
            $table->string('title');
            $table->text('description');
            $table->date('date_time');
            $table->string('location');
            $table->string('banner_image_url')->nullable();
            $table->enum('status', ['scheduled', 'on going', 'done', 'cancelled'])->default('scheduled');
            $table->timestamps();
            $table->foreignUuid('organizer_id')->constrained('users')->onDelete('cascade');
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
