<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTranslate extends Model {
    use SoftDeletes;

    protected $table = 'categories_translate';
    protected $fillable = [
        'category_id', 'lang', 'title', 'slug'
    ];
}
