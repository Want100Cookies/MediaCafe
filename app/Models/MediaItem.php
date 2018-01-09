<?php

namespace App\Models;

use Illuminate\Support\Collection;
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

    protected $pendingRelations;

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

    public static function boot()
    {
        parent::boot();

        self::created(function (MediaItem $model) {
            foreach ($model->pendingRelations as $name => $relation) {
                if ($relation->count() > 0) {
                    $model->setAttribute($name, $relation->toArray());
                }
            }

            $model->save();
        });
    }

    public function __construct(array $attributes = [])
    {
        $this->pendingRelations = [
            'metaSources' => new Collection(),
            'children' => new Collection(),
        ];

        parent::__construct($attributes);
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
        if (! $this->exists) {
            foreach ($metaSources as $source) {
                $this->pendingRelations['metaSources']->push($source);
            }
        } else {
            $this->metaSources()->createMany($metaSources);
        }
    }

    public function setChildrenAttribute($children)
    {
        if (! $this->exists) {
            foreach ($children as $child) {
                $this->pendingRelations['children']->push($child);
            }
        } else {
            $this->children()->createMany($children);
        }
    }
}
