<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);  // Fetch all users
        return view('users.index', compact('users')); // Return to a view (adjust path as needed)
    }


    // public function index()
    // {
    //     $users = User::where('role', 'user')->paginate(10); // Fetch users with role 'user', 10 per page
    //     return view('users.index', compact('users')); // Pass users to the view
    // }



    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = UserRole::cases(); // Fetch all enum roles
        return view('users.create', compact('roles')); // Return the form view
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'employee_id' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:' . implode(',', array_column(UserRole::cases(), 'value')),
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee_id,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user')); // Show details of a specific user
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = UserRole::cases(); // Fetch all enum roles
        return view('users.edit', compact('user', 'roles')); // Return the edit form view
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:' . implode(',', array_column(UserRole::cases(), 'value')),
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from the database.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}