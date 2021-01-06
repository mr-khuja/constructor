<?php

namespace App\Http\Middleware;

use App\Models\Site\Log;
use Closure;
use Illuminate\Http\Request;

class Logging
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $path = $request->path();
        $array = explode('/', $path);
        $route = 'home';
        $action = 'visit';
        if (count($array) > 1) {
            $route = $array[1];
            if (count($array) > 2) {
                $action = $array[2];
            }
        }
        $data = new Log;
        $data->url = $route;
        $data->action = $action;
        $data->user_id = $user->id;
        $data->save();

        return $next($request);
    }
}
