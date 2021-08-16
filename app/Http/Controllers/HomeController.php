<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Advertisement $advertisements)
    {
        $current_date = now();

        if(Auth::user()->is_super_admin()){

            return view('dashboard',
                ['advertisements'=>$advertisements->where('expiration_date','>=',$current_date)->get()]
            );
        }
       else{

           $council_id = Auth::user()->userable->council_id;
           return view('dashboard',['advertisements'=>$advertisements
               ->where('expiration_date','>=',$current_date)
               ->where('council_id',$council_id)->get()]);
       }

    }
}
