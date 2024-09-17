<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model {
    use SoftDeletes;

    protected $table = 'portfolio';
    protected $fillable = ['status', 'category_id', 'order'];

    public function translate(): HasMany {
        return $this->hasMany(PortfolioTranslate::class, 'project_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }

    public function category(): HasOne {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function images(): HasMany {
        return $this->hasMany(PortfolioImage::class, 'project_id', 'id');
    }

    public function image(): HasOne {
        return $this->hasOne(PortfolioImage::class, 'project_id', 'id')->whereFeatured(1);
    }
}
