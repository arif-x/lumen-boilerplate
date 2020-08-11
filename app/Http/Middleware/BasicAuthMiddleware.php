<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class BasicAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->getUser() || !$request->getPassword()) {
            return response('Unauthorized.', 401, ['WWW-Authenticate' => 'Basic']);
        }

        $user = User::whereHas('roles', function($q){
                $q->where('name', 'Superadmin');
            })->where('email', $request->getUser())->first();

        if (!$user || !app('hash')->check($request->getPassword(), $user->password)) {
            return response('Unauthorized.', 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}