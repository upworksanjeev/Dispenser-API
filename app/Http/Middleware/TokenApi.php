<?php

namespace App\Http\Middleware;

use App\Models\SysUser;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class TokenApi
{
    /**
     * @var User
     */
    public static $User;


    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role = 1)
    {
        self::$User = auth()->user();
        if (self::$User == null) abort(401, 'Not authorized');
        //if (time()-self::$User->last_active>60) {
        //    self::$User->last_active = round(microtime(true) * 1000);
            self::$User->save();
        //}
        $response = $next($request)
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Expose-Headers', 'X-Token');


        if (isset($_SERVER['HTTP_ORIGIN'])) {
            $response->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN']);
        } else {
            $response->header('Access-Control-Allow-Origin', 'https://not.you');
        }
        $response->header('X-Role', $role);
        return $response;
    }
}
