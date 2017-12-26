<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/** @mixin \Eloquent */
class MediaItem extends Model
{
    use Sluggable;

    const movieType = 'movie';
    const showType = 'show';
    const seasonType = 'season';
    const episodeType = 'episode';
    const artistType = 'artist';
    const albumType = 'album';
    const songType = 'song';

    protected $fillable = [
        'title',
        'type',
        'number',
        'airDate',
        'description',
        'network',
        'genre',
        'path',
        'monitored',
        'profile_id',
        'metaSources',
        'children',
    ];

    protected $dates = [
        'airDate',
        'created_at',
        'updated_at',
    ];

    public static function allTypes()
    {
        return [
            self::movieType,
            self::showType,
            self::seasonType,
            self::episodeType,
            self::artistType,
            self::albumType,
            self::songType,
        ];
    }

    public static function mainTypes()
    {
        return [
            self::movieType,
            self::showType,
            self::artistType,
        ];
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
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

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function setMetaSourcesAttribute($metaSources)
    {
        if ($this->isDirty()) {
            $this->save();
        }

        foreach ($metaSources as $data) {
            $this->metaSources()->create($data);
        }
    }

    public function setChildrenAttribute($children)
    {
        if ($this->isDirty()) {
            $this->save();
        }

        foreach ($children as $data) {
            $this->children()->create($data);
        }
    }
}
