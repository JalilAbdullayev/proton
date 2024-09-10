<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondSectionTranslate extends Model {
    protected $table = 'second_section_translate';
    protected $fillable = ['title', 'subtitle', 'description', 'second_section_id', 'lang'];
}
