<?php namespace App\MetaSources;

interface IMetaSource
{
    public function search($input);

    public function getMetaData($metaId);

    public function getUrl($metaId);

    public function formatMetaData($metaData);

    public function formatMetaRelations($metaData);
}