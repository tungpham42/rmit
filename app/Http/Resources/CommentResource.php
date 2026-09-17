<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->comment_id,
            'post_id' => $this->post_id,
            'author_id' => $this->user_id,
            'body' => $this->comment_body,
            'hide_name' => (bool) $this->comment_hide_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
