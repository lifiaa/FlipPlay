<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\User;
use App\Models\Media;

class CollectionController extends Controller
{
    public function index(string $userId)
    {
        $user = User::findOrFail($userId);

        $media = $user->media()->latest()->get();

        return MediaResource::collection($media);
    }

    public function store(string $userId, string $mediaId)
    {
        $user = User::findOrFail($userId);
        $media = Media::findOrFail($mediaId);

        $user->media()->syncWithoutDetaching([$media->id]);

        return response()->json([
            'message' => 'Media added to collection successfully',
            'data' => new MediaResource($media)
        ], 201);
    }

    public function destroy(string $userId, string $mediaId)
    {
        $user = User::findOrFail($userId);
        $media = Media::findOrFail($mediaId);

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media removed from collection successfully'
        ]);
    }
}
