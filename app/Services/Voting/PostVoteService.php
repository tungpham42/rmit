<?php

namespace App\Services\Voting;

use App\Models\PostVote;

class PostVoteService extends AbstractVoteService
{
    protected function modelClass(): string
    {
        return PostVote::class;
    }

    protected function ownerKey(): string
    {
        return 'post_id';
    }

    protected function likeColumn(): string
    {
        return 'post_vote_like';
    }

    protected function dislikeColumn(): string
    {
        return 'post_vote_dislike';
    }
}
