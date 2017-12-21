<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** @mixin \Eloquent */
class Torrent extends Model
{
    public function mediaItem()
    {
        return $this->belongsTo(MediaItem::class);
    }

    public function quality()
    {
        return $this->belongsTo(Quality::class);
    }

    public function indexer()
    {
        return $this->belongsTo(Indexer::class);
    }
}
