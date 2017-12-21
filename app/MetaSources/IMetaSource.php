<?php

namespace App\MetaSources;

interface IMetaSource
{
    public function search($input);

    public function getMetaData($metaId);

    public function getUrl($metaId);

    public function mediaItemFactory($metaData, $additional = []);

    public function metaSourceFactory($metaData);

    public function mediaChildFactory($metaData, $additional = []);
}
