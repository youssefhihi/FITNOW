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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('weight');
            $table->integer('height');
            $table->integer('waist_line');
            $table->integer('bicep_thickness');
            $table->integer('pec_width');
            $table->text('performance');
            $table->enum('status', ['finish', 'unfinish'])->default('unfinish');
            $table->timestamp('date')->useCurrent();
            $table->text('additional_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
