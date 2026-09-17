<?php

namespace App\Http\Requests\Course;

use App\Http\Requests\BaseFormRequest;

class CourseRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $required = $this->isUpdate() ? 'sometimes' : 'required';

        return [
            'user_id' => ['nullable', 'integer', 'exists:users,user_id'],
            'course_name' => [$required, 'string', 'max:255'],
            'course_code' => [$required, 'string', 'max:255'],
            'course_allowed' => ['boolean'],
            'course_for_guest' => ['boolean'],
        ];
    }
}
