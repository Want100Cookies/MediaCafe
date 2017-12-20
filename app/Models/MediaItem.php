<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaItem extends Model
{
    public function children()
    {
        return $this->hasMany(MediaItem::class, 'parent_id');
    }

    public function metaSources()
    {
        return $this->hasMany(MetaSource::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class);
    }
}
