<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagTranslate extends Model {
    use SoftDeletes;

    protected $table = 'tags_translate';
    protected $fillable = [
        'tag_id',
        'lang',
        'title',
        'slug'
    ];
}
