<?php

namespace UnderConstruction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UnderConstructionController extends Controller
{
    public function index()
    {
        return view('underconstruction::under_construction');
    }


    public function login()
    {
        return view('underconstruction::under_construction_login');
    }


    public function authenticate(Request $request)
    {
        if( null !== env('UNDER_CONSTRUCTION_LOGIN_KEY')  &&  trim($request->input('key')) == env('UNDER_CONSTRUCTION_LOGIN_KEY') )
        {
            $request->session()->put('DO_NOT_REDIRECT_TO_UNDER_CONSTRUCTION', true);
            return redirect('/');
        }
        else
        {
            $request->session()->flash('status', 'Invalid login key');
        }
        return redirect('/under-construction/login');
    }

    
    public function logout(Request $request)
    {
        $request->session()->forget('DO_NOT_REDIRECT_TO_UNDER_CONSTRUCTION');
        $request->session()->flush();
        return redirect('/');
    }
}