<?php

use App\Http\Controllers\ArticleController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Bài 01: Route có tham số động.
Route::get('/articles/page/{page}', function ($page) {
    return 'Trang bài viết số: '.(int) $page;
})->whereNumber('page')->name('articles.page');

// Bài 01: Tham số tùy chọn và ràng buộc regex slug.
Route::get('/articles/slug/{slug?}', function ($slug = 'khong-co-slug') {
    return 'Slug: '.$slug;
})->where('slug', '[a-z0-9-]+')->name('articles.slug');

// Bài 01: Route group với prefix admin.
Route::prefix('admin')->group(function () {
    Route::get('/articles', fn () => 'Quản trị bài viết')
        ->name('admin.articles.index');
});

// Bài 06: Demo implicit Route Model Binding.
Route::get('/articles/show/{article}', function (Article $article) {
    return view('articles.binding-show', compact('article'));
})->name('articles.binding.show');

// Bài 02: Resource Routes cho ArticleController.
Route::resource('articles', ArticleController::class);
