<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next ,$guard = null)
    {
//        $token

        if (isset($request->token)){
            $token = $request->token;
            $user = User::select('user_id')->where('token', $token)->first();
            if(!empty($user)){
                // have auth
                return $next($request);
            }
            else{
                //not auth ==> error
                return $this->returnError('404','not auth');
            }
        }
        else {
            // not aut ==> error
            return $this->returnError('404','not auth');
        }

     /*   $user_id = $user->user_id;))
        $user = User::select('user_id')->where('token',$token)->first();
        $user_id = $user->user_id*/;
    }
}
