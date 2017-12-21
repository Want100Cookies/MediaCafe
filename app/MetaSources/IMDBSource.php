<?php

namespace App\MetaSources;

use App\Models\MediaItem;

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

    public function formatMetaData($metaData)
    {
        return [];
    }

    public function formatMetaRelations($metaData)
    {
        return [];
    }
}