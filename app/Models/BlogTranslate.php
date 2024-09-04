<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTranslate extends Model {
    use SoftDeletes;

    protected $table = 'blog_translate';
    protected $fillable = [
        'article_id', 'title', 'description', 'lang', 'slug', 'full_text', 'date'
    ];
}
