<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslate extends Model {
    protected $table = 'categories_translate';
    protected $fillable = [
        'category_id', 'lang', 'title', 'slug'
    ];
}
