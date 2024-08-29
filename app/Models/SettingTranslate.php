<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslate extends Model {
    protected $fillable = [
        'title',
        'lang',
        'description',
        'keywords',
        'author',
        'settings_id'
    ];
}
