<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SemesterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->semester_id,
            'code' => $this->semester_code,
            'starts_at' => $this->semester_start_date,
            'ends_at' => $this->semester_end_date,
            'current' => (bool) $this->semester_current,
        ];
    }
}
