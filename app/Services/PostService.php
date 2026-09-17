<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function __construct(private readonly PostRepositoryInterface $posts)
    {
    }

    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return $this->posts->paginate($perPage);
    }

    public function find(int $id): Post
    {
        return $this->posts->findOrFail($id);
    }

    public function create(array $data): Post
    {
        return $this->posts->create($data);
    }

    public function update(Post $post, array $data): Post
    {
        return $this->posts->update($post, $data);
    }

    public function delete(Post $post): bool
    {
        return $this->posts->delete($post);
    }

    public function search(string $term): Collection
    {
        return $this->posts->search($term);
    }
}
