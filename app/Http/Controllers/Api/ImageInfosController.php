<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageInfosRequest;
use App\Models\ImageInfos;
use App\Services\Api\ImageInfosServices;
use Illuminate\Http\Request;

class ImageInfosController extends Controller
{
    private $imageInfosServices;

    public function __construct(ImageInfosServices $imageInfosServices)
    {
        $this->imageInfosServices = $imageInfosServices;
    }

    public function index(Request $request)
    {
        $condition = $request->all('keyword');
        $user = auth()->user();
        $listImages = $this->imageInfosServices->list($user->id, $condition);

        return response()->json([
            'status' => 'success',
            'items' => $listImages,
        ]);
    }

    public function store(ImageInfosRequest $imageInfosRequest)
    {
        $user = auth()->user();
        $inputs = $imageInfosRequest->all('file', 'infos');
        $result = $this->imageInfosServices->create($user->id, $inputs);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'item' => $result,
            ]);
        }

        return response()->json(['status' => 'error'], 422);
    }

    public function update(ImageInfosRequest $imageInfosRequest, ImageInfos $imageInfos)
    {
        $this->authorize('update', $imageInfos);

        $inputs = $imageInfosRequest->all('file', 'infos');
        $result = $this->imageInfosServices->update($imageInfos->id, $inputs);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'item' => $imageInfos,
            ]);
        }

        return response()->json(['status' => 'error'], 422);
    }

    public function delete(ImageInfos $imageInfos)
    {
        $this->authorize('delete', $imageInfos);

        $result = $this->imageInfosServices->delete($imageInfos->id);

        if ($result) {
            return response()->json([
                'status' => 'success',
            ]);
        }

        return response()->json(['status' => 'error'], 422);
    }

    public function detail(ImageInfos $imageInfos)
    {
        $this->authorize('detail', $imageInfos);

        return response()->json([
            'status' => 'success',
            'item' => $imageInfos,
        ]);
    }
}
