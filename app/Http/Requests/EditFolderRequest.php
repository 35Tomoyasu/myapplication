<?php

namespace App\Http\Requests;

use App\Folder;
use Illuminate\Validation\Rule;

class EditFolderRequest extends CreateFolder
{
    public function rules()
    {   
        $rule = parent::rules();

        return $rule;
    }

    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes;
    }
    
    public function messages()
    {
        $messages = parent::messages();

        return $messages;
    }
}
