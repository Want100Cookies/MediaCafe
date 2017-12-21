<?php

namespace App\MetaSources;

use App\Models\MediaItem;

class TheMovieDBSource implements IMetaSource
{
    public function search($input)
    {
        return \Tmdb::getSearchApi()->searchMovies($input);
    }

    public function getMetaData($metaId)
    {
        return \Tmdb::getMoviesApi()->getMovie($metaId);
    }

    public function getUrl($metaId)
    {
        return 'https://www.themoviedb.org/movie/'.$metaId;
    }

    public function mediaItemFactory($metaData, $additional = [])
    {
        return [
            'title' => $metaData['title'],
            'type' => MediaItem::movieType,
            'airDate' => $metaData['release_date'],
            'description' => $metaData['overview'],
            'network' => implode(array_column($metaData['production_companies'], 'name'), ', '),
            'genre' => implode(array_column($metaData['genres'], 'name'), ', '),
            'path' => '/'.$metaData['title'].'/',
        ];
    }

    public function metaSourceFactory($metaData)
    {
        return [
            'metaSources' => [
                [
                    'implementation' => self::class,
                    'meta_id' => $metaData['id'],
                ],
                [
                    'implementation' => IMDBSource::class,
                    'meta_id' => $metaData['imdb_id'],
                ],
            ],
        ];
    }

    public function mediaChildFactory($metaData, $additional = [])
    {
        return [];
    }
}
