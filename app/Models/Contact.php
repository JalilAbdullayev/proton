<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model {
    protected $fillable = [
        'email',
        'phone',
        'map'
    ];

    public function translate(): HasMany {
        return $this->hasMany(ContactTranslate::class);
    }
}
