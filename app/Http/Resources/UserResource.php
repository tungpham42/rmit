<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user_id,
            'role_id' => $this->role_id,
            'alias' => $this->user_alias,
            'name' => $this->name,
            'fullname' => $this->user_fullname,
            'email' => $this->email,
            'status' => (bool) $this->user_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
