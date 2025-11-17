<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'role'  => 'required|in:admin,mentor,mentee',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'role'  => 'required|in:admin,mentor,mentee'
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'User deleted.');
    }
}
