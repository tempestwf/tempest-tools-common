<?php

namespace TempestTools\Common\Laravel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App, Auth;

/**
 * LocalizationMiddleware sets the locale with respect to the user's locale
 *
 * @link    https://github.com/tempestwf
 * @author  Jerome Erazo <https://github.com/jerazo>
 */
class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            App::setLocale($user->getLocale());
        }

        /* locale fallback is set to the config app.fallback_locale so no need to have fallback setting here */

        return $next($request);
    }
}