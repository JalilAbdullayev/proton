<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactTranslate extends Model {
    protected $table = 'contact_translate';
    protected $fillable = ['lang', 'contact_id', 'address'];
}
