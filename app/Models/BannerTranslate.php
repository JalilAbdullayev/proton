<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTranslate extends Model {
    protected $table = 'banner_translate';
    protected $fillable = ['banner_id', 'lang', 'title', 'subtitle'];
}
