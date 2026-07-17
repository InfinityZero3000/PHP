<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    /** Tạo lại schema sạch trong SQLite trước mỗi test. */
    use RefreshDatabase;

    /** Kiểm tra form lưu đúng dữ liệu và chuyển về danh sách. */
    public function test_student_can_be_created(): void
    {
        // Gửi bộ dữ liệu hợp lệ đến route POST /students.
        $response = $this->post('/students', [
            'name' => 'Nguyễn Hữu Thắng',
            'email' => 'thang@huit.edu.vn',
            'age' => 21,
            'gender' => 'male',
            'class_name' => '13DHTH01',
        ]);

        // Xác nhận redirect và flash message đúng đề bài.
        $response->assertRedirect(route('students.db'))->assertSessionHas('success', 'Tạo mới thành công');

        // Xác nhận bản ghi thực sự tồn tại trong database test.
        $this->assertDatabaseHas('students', ['email' => 'thang@huit.edu.vn']);
    }

    /** Kiểm tra email trùng và tuổi dưới 16 bị từ chối. */
    public function test_student_validation_rejects_invalid_data(): void
    {
        // Tạo trước một email để kiểm tra rule unique.
        Student::factory()->create(['email' => 'existing@huit.edu.vn']);

        // Gửi dữ liệu không hợp lệ từ URL của form.
        $response = $this->from('/students/create')->post('/students', [
            'name' => '',
            'email' => 'existing@huit.edu.vn',
            'age' => 15,
            'gender' => 'other',
            'class_name' => '',
        ]);

        // Xác nhận quay về form và có lỗi ở mọi trường sai.
        $response->assertRedirect('/students/create')
            ->assertSessionHasErrors(['name', 'email', 'age', 'gender', 'class_name']);
    }
}
