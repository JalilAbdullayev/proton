<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Banner extends Model {
    protected $table = 'banner';

    public function translate(): HasMany {
        return $this->hasMany(BannerTranslate::class, 'banner_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
