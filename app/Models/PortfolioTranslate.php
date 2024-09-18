<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioTranslate extends Model {
    use SoftDeletes;

    protected $table = 'portfolio_translate';
    protected $fillable = [
        'project_id',
        'lang',
        'title',
        'slug',
        'description',
        'keywords',
        'full_text',
        'category_id'
    ];
}
