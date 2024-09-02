<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTranslate extends Model {
    protected $table = 'services_translate';
    protected $fillable = [
        'service_id',
        'lang',
        'title',
        'slug',
        'keywords',
        'description',
        'full_text'
    ];
}
