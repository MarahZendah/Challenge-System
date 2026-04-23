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
        Schema::create('badges', function (Blueprint $table) {
           $table->id();
        $table->string('name'); // اسم الوسام (مثل: بطل الأسبوع)
        $table->string('description')->nullable(); // وصف الوسام
        $table->string('image_path')->nullable(); // مسار صورة الوسام
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
