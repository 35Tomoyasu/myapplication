<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Task;

class Folder extends Model
{

    // ※12/6メンタリング時修正
    public function folder() 
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        // ※12/6メンタリング時修正
        return $this->hasMany(Task::class);
    }
}
