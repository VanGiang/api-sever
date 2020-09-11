<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageInfos extends Model
{
    protected $table = 'image_infos';

    protected $fillable = [
        'user_id',
        'image_hash',
        'image_name',
        'infos',
    ];

    protected $appends = [
        'image_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        $file = config('image_infos.upload_path') . '/' . $this->user_id . '/' . $this->image_hash;

        return Storage::url($file);
    }
}
