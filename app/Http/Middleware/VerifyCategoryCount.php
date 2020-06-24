<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoryCount
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
        if(Category::all()->count() === 0){

            session()->flash('error', 'Inorder to add posts you need to add categories first');
            return redirect(route('category.index'));
        }
        return $next($request);
    }
}
