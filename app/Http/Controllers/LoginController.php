<?php

namespace App\Http\Controllers;

use App\Models\User;
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
                
                // dd($result);

                $sid = $request->input('sid');

                $url_get_data = "http://hseautomation.beraucoal.co.id/sid2/employeeInfo/bySid/" . $sid . "?expand=employee.functionalPosition,employee.structuralPosition,employee.department,employee.company.status,dedicatedSite,identities.type,employee.status";

                $response2 = Http::withHeaders([
                    'x-api-key' => env('API_BEATS'),
                ])->get($url_get_data);
                
                if ( $response2->successful()){
                    $data_result = $response2->json();
                    
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

                    $user = User::updateOrCreate(
                        ['id' => $id],
                        [
                        'sid' =>$sid,
                        'nik' => $nik,
                        'nik_ktp' => $nik_ktp,
                        'password' => $password,
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
                // if (Auth::attempt(['sid' => '7V2R6', 'password' => '7V2R6'])) {
                //     echo "halo";
                // } else
                // {
                //     echo "oke";
                // }
                if(isset($user) > 0 ) {
                    return redirect('/dashboard');
                }

            }

            } 
            else {
                return back()->withErrors([
                    'sid' => 'Login Failed'.$result['success'],
                ]);
            }
        }

    }
    // protected function masuk($sid, $password){
    //     if (Auth::attempt(['sid' => $sid, 'password' => $password, 'isactive' => 1])) {
    //         return true;
    //     }else
    //     {
    //         return false;
    //     }
    // }
    

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}