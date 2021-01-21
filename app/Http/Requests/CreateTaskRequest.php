<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:30'],
            'contents' => ['required', 'max:255'],
            'finish_date' => 'required',
            'priority' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'タスク名',
            'contents' => '内容',
            'finish_date' => '期限',
            'priority' => '優先度',
        ];
    }

    public function messages(): array
    {
        return [
            'finish_date.required' => ':attribute には今日以降の日時を入力してください。',
            'priority.required' => ':attribute を選択してください。',
        ];
    }
}
