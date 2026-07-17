<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    /** Hiển thị trang giới thiệu khóa học theo yêu cầu Bài 07. */
    public function about(): View
    {
        // Danh sách bảy buổi lab để Blade có thể lặp và đánh STT tự động.
        $labs = [
            'Ôn tập PHP cơ bản và môi trường phát triển',
            'Lập trình hướng đối tượng trong PHP',
            'Làm việc với MySQL và PDO',
            'Git, GitHub và quy trình quản lý mã nguồn',
            'Giới thiệu Laravel, MVC, Routing và Blade',
            'Eloquent ORM, Migration, Factory và Seeder',
            'Xây dựng, kiểm thử và hoàn thiện ứng dụng Laravel',
        ];

        // Truyền lịch lab sang view giới thiệu.
        return view('about', compact('labs'));
    }
}
