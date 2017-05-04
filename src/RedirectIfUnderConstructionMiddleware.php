<?php

namespace Jrl05k\UnderConstruction;

use Closure;

class RedirectIfUnderConstructionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // always allow to see the under construction page...
        //
        if($request->is('under-construction'))
        {
            return $next($request);
        }

        // if under construction not set in env, then continue...
        //
        if( null === env('UNDER_CONSTRUCTION')  ||  false === env('UNDER_CONSTRUCTION') )
        {
            return $next($request);  
        }

        // if under construction not set on localhost, continue
        //
        if( null === env('UNDER_CONSTRUCTION_ON_LOCALHOST')  ||  false === env('UNDER_CONSTRUCTION_ON_LOCALHOST') )
        {
            if($request->ip() == '127.0.0.1')
            {
                return $next($request);  
            }
        }

        // if request ip in allowed ip comma separated list, continue
        //
        if( null !== env('UNDER_CONSTRUCTION_ALLOWED_IP_ADDRESSES') )
        {
            $allowedIpAddresses = explode( ',', env('UNDER_CONSTRUCTION_ALLOWED_IP_ADDRESSES') );
            if(in_array($request->ip(), $allowedIpAddresses))
            {
                return $next($request);
            }
        }


        // if under construction login allowed, check for logged in session, and continue or redirect to under construction login page...
        //
        if( null === env('UNDER_CONSTRUCTION_LOGIN_ALLOWED') ||  false === env('UNDER_CONSTRUCTION_LOGIN_ALLOWED') )
        {
            return redirect('/under-construction');
        }
        else
        {

            // check session and go to next...
            if($request->session()->has('DO_NOT_REDIRECT_TO_UNDER_CONSTRUCTION'))
            {
                return $next($request);
            }

            // check if request login and go to login...
            if($request->is('under-construction/*'))
            {
                return $next($request);
            }

            // redirect under construction...
            return redirect('/under-construction');

        }    
    }
}
