<?php
namespace App\Services\Api;

use App\Models\ImageInfos;
use App\Services\ImageServices;

class ImageInfosServices
{
    private $model;
    private $imageServices;

    public function __construct(ImageInfos $model, ImageServices $imageServices) {
        $this->model = $model;
        $this->imageServices = $imageServices;
    }

    public function list($userId, $condition)
    {
        return $this->model->where('user_id', $userId)
            ->where(function ($query) use ($condition) {
                $query->orWhere('image_name', 'like', '%' . $condition['keyword'] . '%')
                    ->orWhere('infos', 'like', '%' . $condition['keyword'] . '%');
            })
            ->paginate(config('image_infos.per_page'));
    }

    public function create($userId, $inputs)
    {
        $path = config('image_infos.upload_path') . '/' . $userId;
        $fileUploaded = $this->imageServices->uploadFile($inputs['file'], $path);
        if ($fileUploaded) {
            $data = [
                'user_id' => $userId,
                'image_hash' => $fileUploaded,
                'image_name' => $inputs['file']->getClientOriginalName(),
                'infos' => $inputs['infos'],
            ];

            return $this->model->create($data);
        }

        return false;
    }

    public function update($id, $inputs)
    {
        $image = $this->model->find($id);
        if ($image) {
            $data = [
                'infos' => $inputs['infos'],
            ];
            if ($inputs['file']) {
                $path = config('image_infos.upload_path') . '/' . $image->user_id;
                $fileUploaded = $this->imageServices->uploadFile($inputs['file'], $path);
                if ($fileUploaded) {
                    $data['image_hash'] = $fileUploaded;
                    $data['image_name'] = $inputs['file']->getClientOriginalName();

                    return $image->update($data);
                }

                return false;
            }

            return $image->update($data);
        }

        return false;
    }

    public function delete($id)
    {
        $image = $this->model->find($id);
        $path = config('image_infos.upload_path') . '/' . $image->user_id;
        if ($image && $this->imageServices->deleteFile($path, $image->image_hash)) {
            return $image->delete();
        }

        return false;
    }
}
