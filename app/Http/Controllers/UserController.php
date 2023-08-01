<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $is_created = User::create($data);

        return $is_created ? back()->with(['success' => 'Magic has been spelled!']) : back()->with(['failure' => 'Magic has become shopper!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $user->id . ',id'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $is_updated = $user->update($data);

        return $is_updated ? back()->with(['success' => 'Magic has been spelled!']) : back()->with(['failure' => 'Magic has become shopper!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $is_deleted = $user->delete();

        return $is_deleted ? back()->with(['success' => 'User has been temporarily deleted!']) : back()->with(['failure' => 'Magic has become shopper!']);
    }
}
