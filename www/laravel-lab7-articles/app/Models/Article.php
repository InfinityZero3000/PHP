<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public $timestamps = false;

    private const DEMO_ARTICLES = [
        1 => [
            'id' => 1,
            'title' => 'Giới thiệu Laravel 12',
            'body' => 'Nội dung demo cho Route Model Binding.',
        ],
        2 => [
            'id' => 2,
            'title' => 'Blade Components',
            'body' => 'Demo Article model chưa cần migration.',
        ],
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        $article = self::DEMO_ARTICLES[(int) $value] ?? null;

        abort_if($article === null, 404);

        return new self($article);
    }
}
