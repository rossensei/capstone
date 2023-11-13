<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');
        $search = $request->input('search');
        $status = $request->input('status');

        $userQuery = User::query();

        $userQuery->orderBy('name')->with('roles');

        if($role) {
            $userQuery->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            });
        }

        if($search) {
            $userQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if($status && $status == 'true') {
            $userQuery->where('active', true);
        } else if($status == 'false') {
            $userQuery->where('active', false);
        }
        
        $users = $userQuery->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'active' => $user->active,
                'role' => $user->getUserRole(),
                'profile_photo_url' => $user->profile_photo_url,
                'created_at' => $user->created_at,
            ]);

        return inertia('User/Index', [
            'users' => $users,
            'filters' => $request->only(['search', 'role', 'status', 'perPage']),
            'roles' => Role::all()
        ]);
    }

    public function create()
    {
        return inertia('User/Create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required'],
        ]);

        $role = $fields['role'];
        unset($fields['role']);

        $user = User::create($fields);

        $user->assignRole($role);

        return redirect('/users')->with('success', 'User has been created.');
    }

    public function edit(User $user)
    {
        $userWithRoles = User::with(['roles' => function ($query) {
            $query->select('name');
        }])->find($user->id);

        // dd($userWithRoles);
        return inertia('User/Edit', [
            'user' => $userWithRoles,
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $fields = $request->validate([
            'fname' => ['string', 'max:255'],
            'lname' => ['string', 'max:255'],
            'user' => ['string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->update($fields);

        return back();
    }

    public function destroy(User $user)
    {
        if($user->department()->exists()) {
            // dd(true);
            return back()->with('error', 'User cannot be deleted. This user might be handling a facility at this time.');
        }
        $user->delete();

        return back()->with('success', 'User has been removed.');
    }

    public function updateRole(Request $request, User $user)
    {
        $oldRole = $user->getRoleNames();

        foreach($oldRole as $o){
            $user->removeRole($o);
        }

        $user->assignRole($request->role);

        return back();
    }

    public function toggleActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect('/users');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['confirmed', 'min:8', 'required']
        ]);

        $user->password = $request->password;
        $user->save();

        return back();
    }
}
