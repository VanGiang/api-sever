<?php

namespace App\Services;

use Throwable;
use Storage;
use Log;

class ImageServices
{
    public static function uploadFile($file, $path, $delete = false)
    {
        try {
            $storage = Storage::disk(config('filesystems.default'));

            if ($delete) {
                $storage->deleteDirectory($path);
            }

            $result = $storage->put($path, $file);

            if ($result) {
                return $file->hashName();
            }

            return false;
        } catch (Throwable $e) {
            Log::debug($e);

            return false;
        }
    }

    public static function deleteFile($path, $file)
    {
        try {
            $storage = Storage::disk(config('filesystems.default'));

            if ($file) {
                return $storage->delete($path . '/' . $file);
            }

            return false;
        } catch (Throwable $e) {
            Log::debug($e);

            return false;
        }
    }
}
