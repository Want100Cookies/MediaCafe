<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function qualities()
    {
        return $this->belongsToMany(Quality::class)->using(ProfileQuality::class);
    }
}
