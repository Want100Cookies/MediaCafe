<?php

namespace App\MetaSources;

class IMDBSource implements IMetaSource
{
    public function search($input)
    {
        return [];
    }

    public function getMetaData($metaId)
    {
        return [];
    }

    public function getUrl($metaId)
    {
        return "https://www.imdb.com/title/" . $metaId;
    }

    public function mediaItemFactory($metaData, $additional = [])
    {
        return [];
    }

    public function metaSourceFactory($metaData)
    {
        return [];
    }

    public function mediaChildFactory($metaData, $additional = [])
    {
        return [];
    }
}