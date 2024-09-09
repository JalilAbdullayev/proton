<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model {
    use SoftDeletes;

    protected $table = 'blog';
    protected $fillable = [
        'category_id',
        'author_id',
        'status',
    ];

    public function translate(): HasMany {
        return $this->hasMany(BlogTranslate::class, 'article_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }

    public function image(): HasOne {
        return $this->hasOne(BlogImage::class, 'article_id', 'id')->whereFeatured(1);
    }

    public function category(): HasOne {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class, 'blog_tags', 'article_id', 'tag_id')->withTimestamps();
    }

    public function author(): HasOne {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
