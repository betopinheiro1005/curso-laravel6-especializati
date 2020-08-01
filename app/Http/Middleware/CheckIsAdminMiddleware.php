<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd('Estou aqui');

        $user = auth()->user();

        if (!in_array($user->email, ['carlos@especializati.com.br', 'yhermann@example.com'])) {
            return redirect('/');
        }

        return $next($request);
    }
}
