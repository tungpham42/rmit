<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->post_id,
            'author_id' => $this->user_id,
            'course_id' => $this->course_id,
            'repost_id' => $this->repost_id,
            'week' => $this->post_week,
            'title' => $this->post_title,
            'url' => $this->post_url,
            'question' => $this->post_question,
            'answer' => $this->post_answer,
            'hide_name' => (bool) $this->post_hide_name,
            'current' => (bool) $this->post_current,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
