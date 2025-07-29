<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check login 
        // if (!auth()->check()) {
        //     return redirect()->route('login');
        // }

        // Check admin 
        $user = auth()->user();
        // $hasAdminRole = $user->roles()->where('name', 'admin')->exists();

        // if (!$hasAdminRole) {
        //     return redirect()->route('dashboard')
        //         ->with('error', 'Bạn không có quyền truy cập trang này. Chỉ admin mới có thể truy cập.');
        // }

        if($user && $user->roles()->where('name', 'admin')->exists()) {
            return $next($request);
        }
        // return $next($request);
        abort(401, "Unauthorized - Admin access required");
    }
}
