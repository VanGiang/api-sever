<?php

namespace App\Policies;

use App\Models\ImageInfos;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImageInfoPolicies
{
    use HandlesAuthorization;

    public function update(User $user, ImageInfos $imageInfos)
    {
        return $imageInfos->user_id == $user->id;
    }

    public function delete(User $user, ImageInfos $imageInfos)
    {
        return $imageInfos->user_id == $user->id;
    }

    public function detail(User $user, ImageInfos $imageInfos)
    {
        return $imageInfos->user_id == $user->id;
    }
}
