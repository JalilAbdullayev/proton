<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SecondSection extends Model {
    protected $table = 'second_section';
    protected $fillable = ['image'];

    public function translate(): HasMany {
        return $this->hasMany(SecondSectionTranslate::class, 'second_section_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
