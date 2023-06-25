<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class UserController extends Controller
{
    public function switchUser(Request $request, $userId)
    {
        // Find the user to switch to
        $user = User::findOrFail($userId);

        // Authenticate as the selected user
        Auth::login($user);

        // Redirect to the desired page after switching
        return redirect()->route('home')->with('success', 'Switched to user: ' . $user->name);
    }

    // Rest of the controller methods...
}
