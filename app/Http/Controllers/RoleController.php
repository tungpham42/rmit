<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::withCount('users')->orderBy('role_name')->paginate(15);

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        $this->authorize('create', Role::class);

        return view('roles.create');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        // RoleRequest::authorize() already checked 'create' via the policy.
        Role::create($request->validated());

        return redirect()->route('roles.index')->with('success', 'Role created.');
    }

    public function edit(Role $role): View
    {
        $this->authorize('update', $role);

        return view('roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        // RoleRequest::authorize() already checked 'update' via the policy.
        $role->update($request->validated());

        return redirect()->route('roles.index')->with('success', 'Role updated.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('delete', $role);

        if ($role->users()->exists()) {
            return redirect()->route('roles.index')->with('error', 'Cannot delete a role that still has users.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted.');
    }
}
