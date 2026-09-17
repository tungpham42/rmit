<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Following\UserFollowService;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function __construct(private readonly UserFollowService $follows)
    {
    }

    public function store(Request $request, User $user)
    {
        $this->follows->follow($request->user()->user_id, $user->user_id);

        return $this->noContent();
    }

    public function destroy(Request $request, User $user)
    {
        $this->follows->unfollow($request->user()->user_id, $user->user_id);

        return $this->noContent();
    }
}
