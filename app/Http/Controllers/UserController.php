<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('tasks')->get();
        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['name'] = Str::slug($validated['firstname'] . ' ' . $validated['lastname']);

        $userId = DB::table('users')->insertGetId($validated);
        return redirect()->route('users.index')->with('success', 'User created!'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = DB::table('users')->where('id', $user->id)->first();
        $tasks = DB::table('tasks')->where('user_id', $user->id)->get();
        return view('users.show', compact('user', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = DB::table('users')->where('id', $user->id)->first();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $validated['name'] = Str::slug($validated['firstname'] . ' ' . $validated['lastname']);

        DB::table('users')->where(' id', $user->id)->update($validated);
        // $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // $user->delete();
        DB::table('users')->where('id', $user->id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }

    /**
     * Detach role from user.
     */
    public function detachRole(User $user, $roleId)
    {
        // $user->roles()->detach($roleId);
        DB::table('role_user')->where('user_id', $user->id)->where('role_id', $roleId)->delete();
        return redirect()->route('users.show', $user->id)->with('success', 'Role detached!');
    }
}
