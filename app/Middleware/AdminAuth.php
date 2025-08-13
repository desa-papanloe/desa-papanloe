<?php
// app/Http/Middleware/AdminAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if admin is authenticated
        if (!Auth::guard('admin')->check()) {
            // Log the failed authentication attempt
            Log::info('Admin authentication failed', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                    'redirect' => route('admin.login')
                ], 401);
            }
            
            return redirect()->guest(route('admin.login'))
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses admin panel.');
        }

        // Get authenticated admin
        $admin = Auth::guard('admin')->user();

        // Check if admin account is active
        if (!$admin->is_active) {
            // Log the deactivated account access attempt
            Log::warning('Deactivated admin account attempted access', [
                'admin_id' => $admin->id,
                'admin_email' => $admin->email,
                'ip' => $request->ip(),
                'url' => $request->fullUrl()
            ]);

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account deactivated',
                    'redirect' => route('admin.login')
                ], 403);
            }
            
            return redirect()->route('admin.login')
                ->with('error', 'Akun admin Anda telah dinonaktifkan. Hubungi administrator.');
        }

        // Check if admin account is soft deleted
        if ($admin->deleted_at) {
            Log::warning('Deleted admin account attempted access', [
                'admin_id' => $admin->id,
                'admin_email' => $admin->email,
                'ip' => $request->ip()
            ]);

            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found',
                    'redirect' => route('admin.login')
                ], 404);
            }
            
            return redirect()->route('admin.login')
                ->with('error', 'Akun admin tidak ditemukan. Hubungi administrator.');
        }

        // Share admin data with all views
        view()->share('currentAdmin', $admin);

        // Update last activity (optional - for online status tracking)
        if (!$request->ajax() && !$request->wantsJson()) {
            try {
                $admin->touch(); // Updates updated_at timestamp
            } catch (\Exception $e) {
                // Silently handle any database errors
                Log::error('Failed to update admin activity', [
                    'admin_id' => $admin->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $next($request);
    }
}