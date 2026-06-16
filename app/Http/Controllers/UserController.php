<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the registered users.
     */
    public function index()
    {
        if (!Auth::check()) {
            abort(404);
        }

        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }
}
