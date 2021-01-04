<?php

namespace App\Policies;

use App\Folder;
use App\User;

class FolderPolicy
{
    // フォルダの閲覧権限
    public function view(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}
