<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class backofficeArea
{

    const ERROR_MISSING_BACKOFFICE_PERMISSION_GENERAL = 'Your account is misconfigured, your role does not grant access to the backoffice interface';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role() != User::ADMIN) {
            return redirect('/')
                ->with('error', self::ERROR_MISSING_BACKOFFICE_PERMISSION_GENERAL);
        }
        return $next($request);
    }
}
