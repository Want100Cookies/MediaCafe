<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** @mixin \Eloquent */
class MetaSource extends Model
{
    protected $fillable = [
        "implementation",
        "meta_id",
    ];
}
