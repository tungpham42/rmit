<?php

namespace App\Services\Voting;

use App\Models\CommentVote;

class CommentVoteService extends AbstractVoteService
{
    protected function modelClass(): string
    {
        return CommentVote::class;
    }

    protected function ownerKey(): string
    {
        return 'comment_id';
    }

    protected function likeColumn(): string
    {
        return 'comment_vote_like';
    }

    protected function dislikeColumn(): string
    {
        return 'comment_vote_dislike';
    }
}
