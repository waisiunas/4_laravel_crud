<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserTrashedController extends Controller
{
    public function index () {
        return view('user.trashed.index', [
            'users' => User::onlyTrashed()->get()
        ]);
    }

    public function recover (string $id) {
        $user = User::onlyTrashed()->whereId($id)->latest();
        return $user->restore() ? back()->with(['success' => 'User has been restored!']) : back()->with(['failure' => 'Magic has become shopper!']);
    }

    public function delete (string $id) {
        $user = User::onlyTrashed()->whereId($id)->latest();
        return $user->forceDelete() ? back()->with(['success' => 'User has been permanently deleted!']) : back()->with(['failure' => 'Magic has become shopper!']);
    }
}
