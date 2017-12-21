<?php

namespace App\Jobs;

use App\MetaSources\IMetaSource;
use App\Models\MediaItem;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateMediaItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $metaId;
    protected $implementation;
    protected $profileId;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->metaId = $data["meta_id"];
        $this->implementation = $data["implementation"];
        $this->profileId = $data["profile_id"];
    }

    /**
     * Execute the job.
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function handle()
    {
        $source = new $this->implementation();
        if ( ! $source instanceof IMetaSource) {
            $this->fail(new \Exception("Implementation does not implement IMetaSource!"));
        }

        $metaData = $source->getMetaData($this->metaId);

        $additional = [
            "profile_id" => $this->profileId,
            "monitored" => true,
        ];

        \DB::transaction(function () use ($source, $metaData, $additional) {
            $mediaItem = MediaItem::create(
                $source->mediaItemFactory($metaData, $additional)
            );
        });

//        Todo: Fix duplicate key error from de DBMS

//        $mediaItem->update(array_merge(
//            $source->metaSourceFactory($metaData),
//            $source->mediaChildFactory($metaData, $additional)
//        ));
    }
}
