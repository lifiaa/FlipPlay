<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->get();

        return MediaResource::collection($media);
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    public function show(string $id)
    {
        $media = Media::with('users')->findOrFail($id);

        return new MediaResource($media);
    }

    public function update(UpdateMediaRequest $request, string $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->validated());

        return new MediaResource($media->fresh());
    }

    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return response()->json([
            'message' => 'Media deleted successfully'
        ]);
    }
    // pencarian berdasarkan sebagian judul
    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $media = Media::where('title', 'like', '%' . $request->query('title') . '%')
            ->latest()
            ->get();

        return MediaResource::collection($media);
    }
}
