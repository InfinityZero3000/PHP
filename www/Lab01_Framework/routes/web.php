<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Chuyển trang gốc đến danh sách sinh viên DB để dễ kiểm tra ứng dụng.
Route::redirect('/', '/students/db');

// Bài 02: trả chuỗi chào mừng Laravel 12.
Route::get('/hello', fn () => 'Xin chào Laravel 12!')->name('hello');

// Bài 02: trả thời gian hiện tại theo đúng định dạng đề bài.
Route::get('/time', fn () => now()->format('H:i:s d/m/Y'))->name('time');

// Bài 02: cộng hai số nguyên và trả lỗi 400 nếu tham số không hợp lệ.
Route::get('/sum/{a}/{b}', function (string $a, string $b) {
    // Regex bảo đảm nhận đúng số nguyên dương, âm hoặc bằng không.
    if (! preg_match('/^-?\\d+$/', $a) || ! preg_match('/^-?\\d+$/', $b)) {
        return response('Tham số phải là số nguyên', 400);
    }

    // Ép kiểu trước khi cộng để tránh phép nối chuỗi.
    return response((string) ((int) $a + (int) $b));
})->name('sum');

// Bài 03: danh sách sinh viên từ mảng tĩnh.
Route::get('/students', [StudentController::class, 'index'])->name('students.array');

// Bài 04, 06, 09: danh sách sinh viên từ DB.
Route::get('/students/db', [StudentController::class, 'indexDb'])->name('students.db');

// Bài 05: giao diện so sánh hai nguồn dữ liệu.
Route::get('/students/combined', [StudentController::class, 'combined'])->name('students.combined');

// Bài 08: form thêm sinh viên phải khai báo trước route có tham số nếu được bổ sung sau này.
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');

// Bài 08: tiếp nhận, validate và lưu dữ liệu form.
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Bài 07: trang giới thiệu khóa học.
Route::get('/about', [PageController::class, 'about'])->name('about');
