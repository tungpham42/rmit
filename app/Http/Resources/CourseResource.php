<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->course_id,
            'coordinator_id' => $this->user_id,
            'name' => $this->course_name,
            'code' => $this->course_code,
            'allowed' => (bool) $this->course_allowed,
            'for_guest' => (bool) $this->course_for_guest,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
