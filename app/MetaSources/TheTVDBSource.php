<?php namespace App\MetaSources;

use App\Models\MediaItem;
use Carbon\Carbon;
use GuzzleHttp\Client;

class TheTVDBSource implements IMetaSource
{
    protected $client;
    protected static $baseUrl = "http://skyhook.sonarr.tv/v1/tvdb/";

    public function __construct()
    {
        $this->client = new Client();
    }

    public function search($input)
    {
        $response = $this->client->get(self::$baseUrl . "search?term=" . $input);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    public function getMetaData($metaId)
    {
        $response = $this->client->get(self::$baseUrl . "shows/en/" . $metaId);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    public function getUrl($metaId)
    {
        return "https://www.thetvdb.com/?tab=series&id=" . $metaId;
    }

    public function mediaItemFactory($metaData, $additional = [])
    {
        return array_merge(
            [
                "title" => $metaData["title"],
                "type" => MediaItem::showType,
                "airDate" => $metaData["firstAired"],
                "description" => $metaData["overview"],
                "network" => $metaData["network"],
                "genre" => implode($metaData["genres"], ", "),
                "path" => "/" . $metaData["title"] . "/",
            ],
            $additional,
            $this->metaSourceFactory($metaData),
            $this->mediaChildFactory($metaData, $additional)
        );
    }

    public function metaSourceFactory($metaData)
    {
        return [
            "metaSources" => [
                [
                    "implementation" => self::class,
                    "meta_id" => $metaData["tvdbId"],
                ],
                [
                    "implementation" => IMDBSource::class,
                    "meta_id" => $metaData["imdbId"],
                ]
            ],
        ];
    }

    public function mediaChildFactory($metaData, $additional = [])
    {
        return [
            "children" => collect($metaData["seasons"])
                ->filter(function ($season) {
                    return array_key_exists('seasonNumber', $season);
                })
                ->map(function ($season) use ($metaData, $additional) {
                    return array_merge(
                        $additional,
                        [
                            "title" => "Season " . $season["seasonNumber"],
                            "number" => $season["seasonNumber"],
                            "type" => MediaItem::seasonType,
                            "path" => "/Season " . $season["seasonNumber"] . "/",
                            "children" => $this->episodeFactory($season["seasonNumber"], $metaData, $additional),
                        ]
                    );
                })
                ->values() // Discard the keys
        ];
    }

    protected function episodeFactory($seasonNumber, $metaData, $additional)
    {
        return collect($metaData["episodes"])
            ->filter(function ($season) use ($seasonNumber) {
                return array_key_exists("seasonNumber", $season) && $season["seasonNumber"] === $seasonNumber;
            })
            ->map(function ($episode) use ($additional) {
                return array_merge(
                    $additional,
                    [
                        "title" => $episode["title"],
                        "number" => $episode["episodeNumber"],
                        "type" => MediaItem::episodeType,
                        "airDate" => $this->formatUtc($episode["airDateUtc"] ?? null),
                        "description" => $episode["overview"] ?? null
                    ]
                );
            })
            ->values(); // Discard the keys
    }

    protected function formatUtc($date)
    {
        if (strlen($date)) {
            return Carbon::createFromFormat("Y-m-d\TH:i:s\Z", $date, "UTC");
        }
    }
}