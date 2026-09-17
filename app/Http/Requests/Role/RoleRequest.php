<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseFormRequest;
use App\Models\Role;
use Illuminate\Validation\Rule;

class RoleRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        $role = $this->route('role');

        return $role
            ? $this->user()->can('update', $role)
            : $this->user()->can('create', Role::class);
    }

    public function rules(): array
    {
        $roleId = $this->route('role')?->role_id;

        return [
            'role_name' => [
                $this->isUpdate() ? 'sometimes' : 'required', 'string', 'max:60',
                Rule::unique('roles', 'role_name')->ignore($roleId, 'role_id'),
            ],
        ];
    }
}
