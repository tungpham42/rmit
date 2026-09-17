<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\BaseFormRequest;

class CommentRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $required = $this->isUpdate() ? 'sometimes' : 'required';

        return [
            'comment_body' => [$required, 'string'],
            'comment_hide_name' => ['boolean'],
        ];
    }
}
