<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Display the specified user.
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('common.profileShow', compact('user'));
    }
}
