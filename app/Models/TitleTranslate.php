<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitleTranslate extends Model {
    protected $table = 'home_translate';
    protected $fillable = [
        'home_id',
        'lang',
        'services_title',
        'services_subtitle',
        'portfolio_title',
        'portfolio_subtitle',
        'clients_title',
        'team_title',
        'team_subtitle',
        'team_description',
        'blog_title',
        'blog_subtitle'
    ];
}
