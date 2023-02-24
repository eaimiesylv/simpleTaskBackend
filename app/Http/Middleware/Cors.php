<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $domain = parse_url($_SERVER['HTTP_REFERER']);
        $host = '*';
        if (isset($domain['host'])) {
           // $host = $domain['host'];
        }
        //$host = '*';   
        $response->header('Access-Control-Allow-Origin', $host);
        //$response->header("Access-Control-Allow-Credentials","true");
        $response->header("Access-Control-Allow-Methods","POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support
        $response->header("Access-Control-Allow-Headers", "*");
        //$response->header("Access-Control-Allow-Headers", "Content-Type, Accept, Authorization, X-Requested-With, Application");
         
        return $response;
       
   }
}
