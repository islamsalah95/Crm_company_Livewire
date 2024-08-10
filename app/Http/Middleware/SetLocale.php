<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if($request->method() == 'GET' ){
            if ($request->has('lang')) {
                $lang = $request->input('lang');

                $supportedLocales = config('app.supported_locales');
                if (in_array($lang, $supportedLocales)) {
                    app()->setLocale($lang);
                    $response = $next($request);
                    return $response->cookie('lang', $lang); // Set cookie and return response
                } else {
                    app()->setLocale('en');
                    $response = $next($request);
                    return $response->cookie('lang', 'en'); // Set cookie and return response
                }
            } else {
                $myLang = Cookie::get('lang', 'en'); // Get the lang cookie value, default to 'en'
                // If 'lang' cookie is not set, use default 'en' and set the cookie
                if (!Cookie::has('lang') ) {
                    $response = new RedirectResponse($request->url() . '?lang=' . $myLang);
                    return $response->cookie('lang', $myLang);
                }
                // Get the current URL without the lang parameter
                $url = $request->url();
                // Add the lang parameter to the URL
                $redirectUrl = $url . '?lang=' . $myLang;
                // Redirect back to the same page with the lang parameter added
                return new RedirectResponse($redirectUrl);
            }
        }else{



            return $next($request);
        }




    }
}







