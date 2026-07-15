<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    // Bài 3: dữ liệu mảng tĩnh giúp ôn mảng PHP và vòng lặp Blade.
    public function index(): View
    {
        $students = $this->staticStudents();

        return view('students.index', compact('students'));
    }

    // Bài 4, 6, 9: đọc DB, lọc giới tính, sắp xếp mới nhất và phân trang.
    public function indexDb(Request $request): View
    {
        $gender = $request->query('gender');
        $query = Student::query()->orderByDesc('id');

        if (in_array($gender, ['male', 'female'], true)) {
            $query->where('gender', $gender);
        } else {
            $gender = null;
        }

        $students = $query->paginate(5)->withQueryString();

        return view('students.index_db', compact('students', 'gender'));
    }

    // Bài 5: chọn nguồn dữ liệu bằng query string source=array hoặc source=db.
    public function combined(Request $request): View
    {
        $static = $this->staticStudents();
        $db = Student::query()->orderByDesc('id')->paginate(5)->withQueryString();
        $source = $request->query('source') === 'array' ? 'array' : 'db';

        return view('students.combined', compact('static', 'db', 'source'));
    }

    // Bài 8: hiển thị form tạo sinh viên.
    public function create(): View
    {
        return view('students.create');
    }

    // Bài 8: validate dữ liệu trước khi Eloquent ghi xuống DB.
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:students,email'],
            'age' => ['nullable', 'integer', 'min:16'],
            'gender' => ['required', 'in:male,female'],
            'class_name' => ['required', 'string', 'max:255'],
        ]);

        Student::create($validated);

        return redirect()->route('students.db')->with('success', 'Tạo mới thành công');
    }

    private function staticStudents(): array
    {
        return [
            ['name' => 'Nguyễn An', 'age' => 19, 'email' => 'an@huit.edu.vn', 'gender' => 'male', 'class_name' => '12DHTH01'],
            ['name' => 'Trần Bình', 'age' => 18, 'email' => 'binh@huit.edu.vn', 'gender' => 'male', 'class_name' => '12DHTH01'],
            ['name' => 'Lê Chi', 'age' => 17, 'email' => 'chi@huit.edu.vn', 'gender' => 'female', 'class_name' => '12DHTH02'],
            ['name' => 'Phạm Dũng', 'age' => 20, 'email' => 'dung@huit.edu.vn', 'gender' => 'male', 'class_name' => '12DHTH02'],
            ['name' => 'Đỗ Em', 'age' => 21, 'email' => 'em@huit.edu.vn', 'gender' => 'female', 'class_name' => '12DHTH03'],
        ];
    }
}
