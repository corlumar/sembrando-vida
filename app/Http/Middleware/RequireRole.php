<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleName;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if ($user === null) {
            abort(403);
        }

        $enumConstant = RoleName::class.'::'.$role;

        if (! defined($enumConstant)) {
            abort(403);
        }

        /** @var RoleName $requiredRole */
        $requiredRole = constant($enumConstant);

        if (! $user->hasRole($requiredRole)) {
            abort(403);
        }

        return $next($request);
    }
}