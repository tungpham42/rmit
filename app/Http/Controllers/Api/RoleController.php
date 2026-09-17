<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    public function __construct(
        protected RoleRepositoryInterface $roles
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $this->authorize('viewAny', Role::class);

        return RoleResource::collection($this->roles->paginate(15));
    }

    public function show(Role $role): RoleResource
    {
        $this->authorize('view', $role);

        return new RoleResource($role);
    }

    public function store(RoleRequest $request): JsonResponse
    {
        // RoleRequest::authorize() already checked 'create' via the policy.
        $role = $this->roles->create($request->validated());

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(201);
    }

    public function update(RoleRequest $request, Role $role): RoleResource
    {
        // RoleRequest::authorize() already checked 'update' via the policy.
        $this->roles->update($role, $request->validated());

        return new RoleResource($role->fresh());
    }

    public function destroy(Role $role): JsonResponse
    {
        $this->authorize('delete', $role);

        if ($role->users()->exists()) {
            return response()->json([
                'message' => 'Cannot delete a role that still has users.',
            ], 422);
        }

        $this->roles->delete($role);

        return response()->json(null, 204);
    }
}
