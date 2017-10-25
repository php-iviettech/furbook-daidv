<?php

namespace Furbook\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsAdministrator
{
    public function __construct(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$this->auth->user() || !$this->auth->user()->isAdministrator()){
            if($request->ajax()){
                return response('Forbidden' , 403);
            }else{
                throw new AccessDeniedHttpException('Access not allowed');
            }
        }
        return $next($request);
    }
}
