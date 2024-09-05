<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model {
    protected $fillable = ['image'];

    public function translate(): HasMany {
        return $this->hasMany(ServiceTranslate::class, 'service_id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
