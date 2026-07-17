<?php

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** Cho phép model sử dụng StudentFactory để sinh dữ liệu mẫu. */
    use HasFactory;

    /** Khai báo kiểu factory nhằm hỗ trợ IDE và kiểm tra kiểu. */
    protected static function newFactory(): StudentFactory
    {
        return StudentFactory::new();
    }

    /** Các cột được phép gán hàng loạt khi tạo sinh viên. */
    protected $fillable = [
        'name',
        'email',
        'age',
        'gender',
        'class_name',
    ];

    /** Ép cột age thành số nguyên khi đọc từ cơ sở dữ liệu. */
    protected function casts(): array
    {
        return [
            'age' => 'integer',
        ];
    }
}
