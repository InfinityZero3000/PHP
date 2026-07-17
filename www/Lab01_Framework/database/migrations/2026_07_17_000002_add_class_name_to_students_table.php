<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Thêm cột class_name theo yêu cầu tiến hóa CSDL ở Bài 09. */
    public function up(): void
    {
        // Chỉnh sửa bảng đã được tạo bởi migration trước.
        Schema::table('students', function (Blueprint $table): void {
            // Để nullable nhằm an toàn với dữ liệu đã tồn tại trước khi nâng cấp.
            $table->string('class_name')->nullable()->after('gender');
        });
    }

    /** Gỡ cột class_name khi rollback. */
    public function down(): void
    {
        // Chỉ đảo ngược đúng thay đổi của migration này.
        Schema::table('students', function (Blueprint $table): void {
            $table->dropColumn('class_name');
        });
    }
};
