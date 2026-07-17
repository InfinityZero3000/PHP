<?php

namespace Tests\Feature;

use Tests\TestCase;

class HelloRouteTest extends TestCase
{
    /** Kiểm tra nâng cao theo đúng tiêu chí Bài 11. */
    public function test_hello_route_returns_laravel_12_message(): void
    {
        // Gửi GET request giả lập đến route /hello.
        $response = $this->get('/hello');

        // Xác nhận HTTP 200 và nội dung chứa Laravel 12.
        $response->assertOk()->assertSeeText('Laravel 12');
    }

    /** Kiểm tra route cộng trả đúng kết quả và bắt lỗi đầu vào. */
    public function test_sum_route_validates_integer_parameters(): void
    {
        // Hai số nguyên hợp lệ phải trả tổng bằng 12.
        $this->get('/sum/7/5')->assertOk()->assertSeeText('12');

        // Tham số thập phân không phải số nguyên nên phải trả HTTP 400.
        $this->get('/sum/7.5/5')->assertStatus(400)->assertSeeText('Tham số phải là số nguyên');
    }
}
