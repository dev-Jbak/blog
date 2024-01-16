<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSameUserPost
{
    public function handle($request, Closure $next)
    {
        $postId = $request->user_id;

        dd($request->route()->getParameter('comment'));
        //if you have route model binding then $userId will be the instance of the binded instance.
        //else it will be the number from the url 
        //eg: if url is like this: site/profile/123/edit then $userId will be 123

        // for model binding
        // if($userId->id == Auth::id()){
        //     return $next($request);
        // }
        // else{
        //     return redirect(); //redirect anyware.
        // }
        
        //for Non model binding
        // if($userId == Auth::id()){
        //     return $next($request);
        // }
        // else{
        //     return redirect(); //redirect anyware.
        // }   
    }   
}
