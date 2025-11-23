<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AparaturController extends Controller
{
    public function index()
    {
        if (session('my_session')) {
            return "dfdf";
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {
        $curl = curl_init();

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ], [
            'email.required' => 'Email Failed',
            'password.required' => 'Password Failed',
        ]);

        $postdata = http_build_query(array(
            'email' => $request->email,
            'password' => $request->password
        ));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://simpeg.sijunjung.go.id/api/loginpppk.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postdata,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $jd = json_decode($response, true);

        $code = $jd['code'];
        if ($code == '200') {
            session(['my_session' => $jd]);
            return redirect()->route('login');
        }
        return redirect()->back();
    }
}
