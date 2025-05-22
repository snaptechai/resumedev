<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\AccessUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with(['accessUsers', 'accessUsers.access'])->orderByDesc('id');

        $users = $query->paginate(10);
        $permissions = Access::all();

        return view('admin.users.index', [
            'users' => $users,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Access::all();

        return view('admin.users.create', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user,username',
            'type' => 'required|string|in:System,Writer,Client',
            'password' => ['required', 'confirmed', Password::defaults()],
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:access,id',
        ]);

        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'type' => $request->type,
            'password' => Hash::make($request->password),
            'registered_date' => now(),
            'added_by' => Auth::id(),
            'added_date' => now(),
        ]);

        if ($request->has('permissions') && is_array($request->permissions && auth()->user()->hasPermission('Manage user access'))) {
            foreach ($request->permissions as $permissionId) {
                AccessUser::create([
                    'user' => $user->id,
                    'access' => $permissionId,
                    'added_by' => Auth::id(),
                    'added_date' => now(),
                ]);
            }
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['accessUsers', 'accessUsers.access'])->findOrFail($id);

        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $permissions = Access::all();

        return view('admin.users.edit', [
            'user' => $user,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'full_name' => 'required|string|max:255',
            'type' => 'required|string|in:System,Writer,Client',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:access,id',
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $request->validate($rules);

        $userData = [
            'full_name' => $request->full_name,
            'type' => $request->type,
            'last_modified_by' => Auth::id(),
            'last_modified_date' => now(),
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        if (auth()->user()->hasPermission('Manage user access')) {

            AccessUser::where('user', $user->id)->delete();

            if ($request->has('permissions') && is_array($request->permissions)) {
                foreach ($request->permissions as $permissionId) {
                    AccessUser::create([
                        'user' => $user->id,
                        'access' => $permissionId,
                        'added_by' => Auth::id(),
                        'added_date' => now(),
                    ]);
                }
            }
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
