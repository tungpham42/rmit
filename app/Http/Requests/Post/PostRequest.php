<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\BaseFormRequest;

class PostRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $required = $this->isUpdate() ? 'sometimes' : 'required';

        return [
            'user_id' => [$required, 'integer', 'exists:users,user_id'],
            'course_id' => [$required, 'integer', 'exists:courses,course_id'],
            'repost_id' => ['nullable', 'integer', 'exists:posts,post_id'],
            'post_week' => [$required, 'integer'],
            'post_title' => [$required, 'string', 'max:255'],
            'post_url' => [$required, 'string', 'max:60'],
            'post_question' => [$required, 'string'],
            'post_answer' => ['nullable', 'string'],
            'post_hide_name' => ['boolean'],
            'post_current' => ['boolean'],
        ];
    }
}
