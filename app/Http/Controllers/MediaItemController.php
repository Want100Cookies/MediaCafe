<?php

namespace App\Http\Controllers;

use App\Jobs\CreateMediaItem;
use App\Models\MediaItem;
use Illuminate\Http\Request;

class MediaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->query('type');

        abort_if(! in_array($type, MediaItem::mainTypes()), 404, "Type not found");

        return response()->success(MediaItem::where('type', $type)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'meta_id' => 'required',
            'implementation' => 'required',
            'profile_id' => 'required|exists:profiles,id',
        ]);

        abort_if(!class_exists($data['implementation']), 403, "Class does not exist!");

        CreateMediaItem::dispatch($data);

        return response(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MediaItem $mediaItem
     *
     * @return \Illuminate\Http\Response
     */
    public function show(MediaItem $mediaItem)
    {
        return response()->success($mediaItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\MediaItem $mediaItem
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaItem $mediaItem)
    {
        $data = $request->validate([
            'profile_id' => 'sometimes,exists:profiles,id',
            'monitored' => 'sometimes|boolean',
            'path' => 'sometimes|string'
        ]);

        if ($mediaItem->update($data)) {
            return response(null, 204);
        } else {
            return response("Something went wrong", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MediaItem $mediaItem
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(MediaItem $mediaItem)
    {
        if ($mediaItem->delete()) {
            return response(null, 204);
        } else {
            return response("Something went wrong", 500);
        }
    }
}
