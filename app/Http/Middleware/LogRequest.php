<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      $log = "";
        if (Auth::guard($guard)->check()) {
          //usuario logado / Auth::user()->id;
          $log = Auth::user()->email." Acessou a URL ".$request->fullUrl()." ". json_encode($request->all());
        } else {
          $log = "Acessou a URL ".$request->fullUrl()." ". json_encode($request->all());
        }

        $resp = $next($request);
        if (strpos($request->fullUrl(), "api") !== false) {
          $log = $log." ".$resp->getContent();
        }
        Log::info($log);

        return $resp;
    }
}
