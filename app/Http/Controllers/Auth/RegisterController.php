<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // New sign-ups always get the "student" role, resolved by name so it
        // doesn't depend on seeding order or role_id values.
        $defaultRoleId = Role::where('role_name', RoleName::default()->value)->first()?->role_id;

        abort_if($defaultRoleId === null, 500, 'Default role is not seeded. Run the RoleSeeder.');

        $user = User::create([
            'role_id' => $defaultRoleId,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_status' => true,
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('roles.index')->with('success', 'Account created. Welcome, '.$user->name.'.');
    }
}
