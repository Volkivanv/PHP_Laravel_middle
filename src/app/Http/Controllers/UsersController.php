<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    //
    public function index()
    {
        $this->authorize('view-any', User::class);
     //   Gate::authorize('view-users');
        return User::all();
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return $user;
    }
}
