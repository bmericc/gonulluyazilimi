<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class SeminarController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->middleware('auth');

            if(!Auth::check() ) {
                return redirect('/login')->with('redirect', URL::full() );
            }

            if(Auth::user()->role!=1 )  {
                return redirect('/login')->with('redirect', URL::full() );
            }

            return $next($request);
        });
    }

    public function getList() {

        if(Auth::user()->role!=1 )  {
            return Redirect::to(secure_url('/home'))->with("status", "Bu bölüm yapım aşamasında");
        }

        dump("seminer talepleri");

    }

    public function getCreate() {

        return view('user.create_seminar_request');

    }

    public function postCreate(Request $request) {

    }
}