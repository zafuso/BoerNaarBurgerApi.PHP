<?php

namespace App\Http\Middleware;

use App\Exceptions\ServiceException;
use Closure;
use Illuminate\Http\Request;

class ServiceRouteAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws ServiceException
     */
    public function handle(Request $request, Closure $next)
    {
        $appServiceGuid = $request->header('X-APP-SERVICE-GUID');
        if (!isset($appServiceGuid)) {
            return response()->json(['error' => 'This action is forbidden.'], 401);
        }

        if ($appServiceGuid !== env('APP_SERVICE_GUID')) {
            return response()->json(['error' => 'Invalid authentication header.'], 401);
        }

        return $next($request);
    }
}
