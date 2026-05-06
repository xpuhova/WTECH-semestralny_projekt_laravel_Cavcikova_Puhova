<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create a new class instance.
     */
    public function toResponse($request)
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.inventory');
        }

        return redirect()->route('profile');
    }

    public function __construct()
    {
        //
    }
}
