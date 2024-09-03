<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use SoftDeletes;

    protected $fillable = [
        'status',
        'category_id'
    ];

    public function translate(): HasMany {
        return $this->hasMany(CategoryTranslate::class, 'category_id', 'id');
    }
}
