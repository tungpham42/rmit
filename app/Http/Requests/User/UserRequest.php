<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        $target = $this->route('user');

        return $target
            ? $this->user()->can('update', $target)
            : $this->user()->can('create', User::class);
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->user_id;
        $required = $this->isUpdate() ? 'sometimes' : 'required';

        // Only an admin may set/change role_id; everyone else editing their
        // own profile keeps whatever role they already have.
        $roleRule = $this->user()?->isAdmin()
            ? [$required, 'integer', 'exists:roles,role_id']
            : ['prohibited'];

        return [
            'role_id' => $roleRule,
            'user_alias' => ['nullable', 'string', 'max:32'],
            'name' => [$required, 'string', 'max:255'],
            'password' => [$this->isUpdate() ? 'nullable' : 'required', 'string', 'min:8'],
            'email' => [
                $required, 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($userId, 'user_id'),
            ],
            'user_status' => ['boolean'],
        ];
    }
}
