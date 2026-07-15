<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Bài 9: migration mới giúp phát triển cấu trúc mà không sửa migration cũ.
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table): void {
            $table->string('class_name')->after('gender');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table): void {
            $table->dropColumn('class_name');
        });
    }
};
