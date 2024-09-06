<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class About extends Model {
    protected $table = 'about';
    protected $fillable = ['image'];

    public function translate(): HasMany {
        return $this->hasMany(AboutTranslate::class);
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
