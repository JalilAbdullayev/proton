<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortfolioImage extends Model {
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'image',
        'status',
        'featured'
    ];
}
