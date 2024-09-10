<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FirstSectionTranslate extends Model {
    protected $table = 'first_section_translate';
    protected $fillable = [
        'first_section_id',
        'lang',
        'title',
        'subtitle',
        'description'
    ];
}
