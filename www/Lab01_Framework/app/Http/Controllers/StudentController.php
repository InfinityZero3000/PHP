<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /** Hiển thị danh sách sinh viên lấy từ mảng PHP tĩnh (Bài 03). */
    public function index(): View
    {
        // Khai báo tối thiểu năm sinh viên đúng cấu trúc đề bài.
        $students = [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' => 'an@huit.edu.vn'],
            ['name' => 'Trần Bình', 'age' => 18, 'email' => 'binh@huit.edu.vn'],
            ['name' => 'Lê Chi', 'age' => 17, 'email' => 'chi@huit.edu.vn'],
            ['name' => 'Phạm Dũng', 'age' => 20, 'email' => 'dung@huit.edu.vn'],
            ['name' => 'Đỗ Em', 'age' => 21, 'email' => 'em@huit.edu.vn'],
        ];

        // Truyền mảng students sang Blade bằng cú pháp compact.
        return view('students.index', compact('students'));
    }

    /** Hiển thị dữ liệu Eloquent, có lọc giới tính và phân trang (Bài 04, 06, 09). */
    public function indexDb(Request $request): View
    {
        // Chỉ chấp nhận hai giá trị lọc hợp lệ; giá trị khác được xem như không lọc.
        $gender = in_array($request->query('gender'), ['male', 'female'], true)
            ? $request->query('gender')
            : null;

        // Khởi tạo truy vấn và sắp bản ghi mới nhất lên đầu.
        $query = Student::query()->orderByDesc('id');

        // Thêm điều kiện WHERE khi người dùng chọn giới tính.
        $query->when($gender, fn ($builder, $value) => $builder->where('gender', $value));

        // Lấy năm bản ghi mỗi trang và giữ query string khi chuyển trang.
        $students = $query->paginate(5)->withQueryString();

        // Trả danh sách và giá trị bộ lọc về view.
        return view('students.index_db', compact('students', 'gender'));
    }

    /** So sánh mảng tĩnh và dữ liệu Eloquent trong cùng giao diện (Bài 05). */
    public function combined(Request $request): View
    {
        // Tạo dữ liệu PHP thuần cho tab Array.
        $static = [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' => 'an@huit.edu.vn', 'gender' => 'male'],
            ['name' => 'Trần Bình', 'age' => 18, 'email' => 'binh@huit.edu.vn', 'gender' => 'male'],
            ['name' => 'Lê Chi', 'age' => 17, 'email' => 'chi@huit.edu.vn', 'gender' => 'female'],
        ];

        // Truy vấn dữ liệu DB và phân trang theo yêu cầu.
        $db = Student::query()->orderByDesc('id')->paginate(5)->withQueryString();

        // Mặc định mở tab DB; chỉ nhận source=array hoặc source=db.
        $source = $request->query('source') === 'array' ? 'array' : 'db';

        // Truyền cả hai nguồn dữ liệu và tab đang chọn sang view.
        return view('students.combined', compact('static', 'db', 'source'));
    }

    /** Hiển thị form thêm sinh viên mới (Bài 08). */
    public function create(): View
    {
        // View này chỉ hiển thị form nên không cần truyền dữ liệu ban đầu.
        return view('students.create');
    }

    /** Kiểm tra dữ liệu và lưu sinh viên mới vào DB (Bài 08). */
    public function store(Request $request): RedirectResponse
    {
        // Validate toàn bộ trường theo đúng giới hạn trong PDF.
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'age' => ['nullable', 'integer', 'min:16'],
            'gender' => ['required', 'in:male,female'],
            'class_name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã tồn tại.',
            'age.integer' => 'Tuổi phải là số nguyên.',
            'age.min' => 'Tuổi phải từ 16 trở lên.',
            'gender.required' => 'Vui lòng chọn giới tính.',
            'gender.in' => 'Giới tính không hợp lệ.',
            'class_name.required' => 'Vui lòng nhập tên lớp.',
        ]);

        // Eloquent tạo bản ghi bằng các cột đã khai báo fillable.
        Student::create($validated);

        // Chuyển về danh sách DB và gửi flash message chỉ tồn tại một request.
        return redirect()->route('students.db')->with('success', 'Tạo mới thành công');
    }
}
