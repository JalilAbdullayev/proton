<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
    use SoftDeletes;

    protected $fillable = [
        'status'
    ];

    public function translate(): HasMany {
        return $this->hasMany(TagTranslate::class, 'tag_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }

    public function articles(): BelongsToMany {
        return $this->belongsToMany(Blog::class, 'blog_tags', 'tag_id', 'article_id')->withTimestamps();
    }
}
