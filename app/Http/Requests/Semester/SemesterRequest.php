<?php

namespace App\Http\Requests\Semester;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class SemesterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $semesterId = $this->route('semester')?->semester_id;
        $required = $this->isUpdate() ? 'sometimes' : 'required';

        return [
            'semester_code' => [
                $required, 'string', 'max:255',
                Rule::unique('semesters', 'semester_code')->ignore($semesterId, 'semester_id'),
            ],
            'semester_start_date' => [$required, 'date'],
            'semester_end_date' => [$required, 'date', 'after:semester_start_date'],
            'semester_current' => ['boolean'],
        ];
    }
}
