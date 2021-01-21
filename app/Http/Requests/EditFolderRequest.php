<?php

declare(strict_types = 1);

namespace App\Http\Requests;

class EditFolderRequest extends CreateFolderRequest
{   
    public function rules(): array

    {   
        $rule = parent::rules();

        return $rule;
    }

    public function attributes(): array
    {
        $attributes = parent::attributes();

        return $attributes;
    }
    
    public function messages(): array
    {
        $messages = parent::messages();

        return $messages;
    }
}
