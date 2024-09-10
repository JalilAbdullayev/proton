<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FirstSection extends Model {
    protected $table = 'first_section';
    protected $fillable = [
        'image',
    ];

    public function translate(): HasMany {
        return $this->hasMany(FirstSectionTranslate::class, 'first_section_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
