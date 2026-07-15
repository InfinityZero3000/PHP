<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Bài 1: trang chủ xác nhận dự án Laravel đã chạy.
Route::view('/', 'welcome')->name('home');

// Bài 2: ba route closure ôn PHP cơ bản trong Laravel.
Route::get('/hello', fn (): string => 'Xin chào Laravel 12!')->name('hello');
Route::get('/time', fn (): string => now()->format('H:i:s d/m/Y'))->name('time');
Route::get('/sum/{a}/{b}', function (string $a, string $b) {
    // Regex bảo đảm chỉ chấp nhận số nguyên, kể cả số âm.
    if (! preg_match('/^-?\d+$/', $a) || ! preg_match('/^-?\d+$/', $b)) {
        return response('Tham số phải là số nguyên', 400);
    }

    return (string) ((int) $a + (int) $b);
})->name('sum');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/db', [StudentController::class, 'indexDb'])->name('students.db');
Route::get('/students/combined', [StudentController::class, 'combined'])->name('students.combined');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
