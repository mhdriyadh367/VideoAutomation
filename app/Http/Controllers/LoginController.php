<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'sid'=> 'required','string','max:5',
            'password' => 'required'
        ]);

        $body = [
            "username" => $request->input('sid'),
            "password" => $request->input('password'),
        ];

        $url_login = 'http://hseautomation.beraucoal.co.id/beats/api/mobile/login';

        $response = Http::withHeaders([
            'x-api-key' => env('API_BEATS'),
        ])->post($url_login, $body);

        if ( $response->successful())
        {
            $result = $response->json();

            if($result['message'] !== '' && $result['success'] == true)
            {
                // return route('home');
                dd($result);
                
            } 
            else {
                return back()->withErrors([
                    'sid' => 'The provided credentials do not match our records.'.$result['success'],
                ]);
            }
        }
        





        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();

        //     return redirect()->intended('/dashboard');
        // }

        // return back()->with('loginError', 'Login failed');
    }
    

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
