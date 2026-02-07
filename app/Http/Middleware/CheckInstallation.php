<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $installedFile = storage_path('installed');
        
        // Check if installation file exists
        if (!File::exists($installedFile)) {
            // If trying to access install routes, allow
            if ($request->is('install') || $request->is('install/*')) {
                return $next($request);
            }
            
            // Redirect to installation
            return redirect()->route('install.index');
        }
        
        // If already installed and trying to access install routes
        if ($request->is('install') || $request->is('install/*')) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
