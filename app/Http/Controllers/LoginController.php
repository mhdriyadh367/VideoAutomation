<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    protected $redirectTo = '/';
    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $response = $this->checkLoginApi($request);

        //dd($response->clientError());
        
        if ( $response->successful() )
        {
            $result = $response->json();

            if($result['message'] !== '' && $result['success'] == true)
            {
                $response2 = $this->getApiData($request);
                
                if ( $response2->successful())
                {
                    $data_result = $response2->json();

                    $this->updateDatabase($request, $result, $data_result);
                }

                if ( $this->attemptLogin($request) ) 
                {
                    return redirect('/dashboard');
                } 
                
                return back()->withErrors([
                    'sid' => 'Login Failed'
                ]);
            } 
        }

        if ( $this->attemptLogin($request) ) 
        {
            return redirect('/dashboard');
        } 

        return back()->withErrors([
            'sid' => 'Login Failed',
        ]);

    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        // request()->session()->regenerateToken();
        return redirect('/');
    }

    public function username()
    {
        return 'sid';
    }

    protected function getApiData(Request $request)
    {
        $sid = $request->input( $this->username() );

        $url_get_data = "http://hseautomation.beraucoal.co.id/sid2/employeeInfo/bySid/" . $sid . "?expand=employee.functionalPosition,employee.structuralPosition,employee.department,employee.company.status,dedicatedSite,identities.type,employee.status";

        return Http::withHeaders([
            'x-api-key' => env('API_BEATS'),
        ])->get($url_get_data);
    }

    protected function checkLoginApi(Request $request)
    {
        $body = [
            "username" => $request->input( $this->username() ),
            "password" => $request->input('password'),
        ];

        $url_login = 'http://hseautomation.beraucoal.co.id/beats/api/mobile/login';

        return Http::withHeaders([
            'x-api-key' => env('API_BEATS'),
        ])->post($url_login, $body);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|max:5',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt([ 
            'sid' =>  $request->input($this->username()),
            'password' => $request->input('password') , 
            'isactive' => '1' 
        ]);
    }

    public function updateDatabase(Request $request, $result, $data_result)
    {               
        $id = $result['idKaryawan'];
                    
        $nik = $data_result['employee']['employeeIdNumber'];
        $nik_ktp = '';
        $password = $request->input('password');
        $id_company = $data_result['employee']['company']['id'];
        $id_department = $data_result['employee']['department']['id'];
        $pjo = '';
        $struktural = $data_result['employee']['structuralPosition']['name'];
        $fungsional = $data_result['employee']['functionalPosition']['name'];
        $nama = $data_result['employee']['name'];
        $tanggal_lahir = $data_result['employee']['dateOfBirth'];
        $telp = $data_result['employee']['phone'];
        $alamat = $data_result['employee']['address'];
        $dedicated_site = $data_result['dedicatedSite']['id'];
        $nama_site = $data_result['dedicatedSite']['name'];
        // $isactive = $data_result['employee']['status']['name'];
        if ($data_result['employee']['status']['name'] == "AKTIF") {
            $isactive = '1';
        } else {
            $isactive = '0';
        }

        return User::updateOrCreate(
            ['id' => $id],
            ['sid' =>$request->input('sid'),
            'nik' => $nik,
            'nik_ktp' => $nik_ktp,
            'password' => Hash::make($password),
            'id_company' => $id_company,
            'id_department' => $id_department,
            'pjo' => $pjo,
            'struktural' => $struktural,
            'fungsional' => $fungsional,
            'nama' => $nama,
            'tanggal_lahir' => $tanggal_lahir,
            'telp' => $telp,
            'alamat' => $alamat,
            'dedicated_site' => $dedicated_site,
            'nama_site' => $nama_site,
            'isactive' => $isactive,
            ],    
        );
    }
}