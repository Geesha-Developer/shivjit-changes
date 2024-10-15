<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Teamlead;

/**
 * Get the current user and guard based on the credentials provided.
 *
 * @param array $credentials
 * @return mixed
 */
function getCurrentUserAndGuard(array $credentials)
{
    // Check if the user exists in the 'teamlead' table
    $teamLead = Teamlead::where('email', $credentials['email'])->first();

    if ($teamLead && Hash::check($credentials['password'], $teamLead->password)) {
        // Return the user and guard if authenticated
        return [
            'user' => $teamLead,
            'guard' => 'teamlead',
        ];
    }

    // Attempt to authenticate with the 'web' guard
    if (Auth::guard('web')->attempt($credentials)) {
        // Return the user and guard if authenticated
        return [
            'user' => Auth::guard('web')->user(),
            'guard' => 'web',
        ];
    }

    // Return null if no valid authentication is found
    return null;
}

/**
 * Set the user to the auth guard.
 *
 * @param array $userAndGuard
 */
function setUserToAuthGuard(array $userAndGuard)
{
    $guard = $userAndGuard['guard'];
    $user = $userAndGuard['user'];

    Auth::guard($guard)->login($user);
}
