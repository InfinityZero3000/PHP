<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Tạo bảng students theo cấu trúc Bài 04. */
    public function up(): void
    {
        // Schema Builder giúp cấu trúc chạy nhất quán trên MySQL.
        Schema::create('students', function (Blueprint $table): void {
            // Khóa chính BIGINT UNSIGNED tự tăng.
            $table->id();
            // Họ tên sinh viên, mặc định tối đa 255 ký tự.
            $table->string('name');
            // Email không được trùng giữa các sinh viên.
            $table->string('email')->unique();
            // Tuổi là số nguyên không âm và được phép để trống.
            $table->unsignedInteger('age')->nullable();
            // Giới tính được lưu dạng chuỗi male hoặc female.
            $table->string('gender')->nullable();
            // Tạo đồng thời created_at và updated_at.
            $table->timestamps();
        });
    }

    /** Xóa bảng khi rollback migration. */
    public function down(): void
    {
        // dropIfExists tránh lỗi nếu bảng chưa tồn tại.
        Schema::dropIfExists('students');
    }
};
