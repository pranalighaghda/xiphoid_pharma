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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('title');
            $table->text('small_desc')->nullable();
            $table->text('content')->nullable();
            $table->string('btn_text')->nullable();
            $table->string('btn_url')->nullable();
            $table->enum('btn_is_new_tab', ['0', '1'])->default('0');
            $table->enum('is_entries', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
