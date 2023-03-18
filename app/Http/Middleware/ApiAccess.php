<?php

namespace App\Http\Middleware;

use App\Enums\EnumsEntity;
use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiAccess
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        if(!$request->ip()){
            return $this->jsonResponse(EnumsEntity::irngv_api_msg_code[1], 403,[], 1);
        }
        $user = User::where('valid_ip', $request->ip())->first();
        // Log::info($request->input('api_token'));
        // Log::info($request->ip());
        if(!$user){
            return $this->jsonResponse(EnumsEntity::irngv_api_msg_code[2],403, [], 2);
        }
        if( !$request->input('api_token')){
            return $this->jsonResponse(EnumsEntity::irngv_api_msg_code[3], 403, [], 3);
        }
        if($user->api_token != $request->input('api_token')){
            return $this->jsonResponse(EnumsEntity::irngv_api_msg_code[4],403, [], 4);
        }

        $now = Carbon::now();
        $diff = $now->diffInMinutes($user->updated_at);
        if($diff >= 10){
            return $this->jsonResponse(EnumsEntity::irngv_api_msg_code[5], 403, [], 5);
        }

        return $next($request);
    }
}
