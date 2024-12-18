<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Settings extends Model {
    protected $fillable = [
        'logo',
        'favicon',
    ];

    public function translate(): HasMany {
        return $this->hasMany(SettingTranslate::class);
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
