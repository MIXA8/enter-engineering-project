<?php

namespace App\Http\Middleware;

use App\Enums\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentIdCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role === UserRoleEnum::DIRECTOR || Auth::user()->role === UserRoleEnum::TEACHER) {
            return $next($request);
        } elseif (Auth::user()->role === UserRoleEnum::STUDENT && Auth::user()->id == $request->id) {
            return $next($request);
        }

        abort(403);
    }
}
