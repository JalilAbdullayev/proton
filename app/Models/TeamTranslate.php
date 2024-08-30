<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamTranslate extends Model {
    protected $table = 'team_translate';
    protected $fillable = [
        'member_id',
        'name',
        'position',
        'lang'
    ];
}
