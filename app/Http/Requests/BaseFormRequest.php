<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage', Role::class);
    }

    /**
     * True when this request is updating an existing resource (PUT/PATCH),
     * so subclasses can relax "required" rules to "sometimes" in one place.
     */
    protected function isUpdate(): bool
    {
        return $this->isMethod('put') || $this->isMethod('patch');
    }
}
