<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    public function __construct(private readonly CommentRepositoryInterface $comments)
    {
    }

    public function forPost(int $postId): Collection
    {
        return $this->comments->forPost($postId);
    }

    public function find(int $id): Comment
    {
        return $this->comments->findOrFail($id);
    }

    public function create(array $data): Comment
    {
        return $this->comments->create($data);
    }

    public function update(Comment $comment, array $data): Comment
    {
        return $this->comments->update($comment, $data);
    }

    public function delete(Comment $comment): bool
    {
        return $this->comments->delete($comment);
    }
}
