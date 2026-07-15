<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    // Bài 7: controller chỉ điều phối việc trả về trang giới thiệu.
    public function about(): View
    {
        $labs = [
            'Lab 1: Làm quen PHP và môi trường phát triển',
            'Lab 2: Biến, toán tử, điều kiện và vòng lặp',
            'Lab 3: Hàm, mảng và xử lý form',
            'Lab 4: Lập trình hướng đối tượng trong PHP',
            'Lab 5: Kết nối và thao tác dữ liệu MySQL',
            'Lab 6: Laravel Framework, MVC, Blade và Eloquent',
            'Lab 7: Hoàn thiện ứng dụng web bằng Laravel',
        ];

        return view('about', compact('labs'));
    }
}
