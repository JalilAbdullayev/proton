<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model {
    protected $table = 'team';
    protected $fillable = ['image', 'order'];

    public function translate(): HasMany {
        return $this->hasMany(TeamTranslate::class, 'member_id', 'id');
    }

    public function translated(): HasMany {
        return $this->translate()->where('lang', session('locale'));
    }
}
