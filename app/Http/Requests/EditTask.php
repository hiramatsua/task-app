<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Task;

class EditTask extends CreateTask
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();    //Request_CreateTaskを継承

        $status_rule = Rule::in(array_keys(Task::STATUS));
        // -> 'in(1, 2, 3)' を出力する'status' => 'required|in(1, 2, 3)',
        return $attributes + [
            'status' => '進捗',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
