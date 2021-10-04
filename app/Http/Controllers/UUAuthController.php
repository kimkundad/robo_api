<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class UUAuthController extends Controller
{
    public $successStatus = 200;
    //
    public function handleProviderCallback(Request $request){

        $codeVerifier = $request->session()->pull('code_verifier');

        $response = Http::asForm()->post('https://siamtheatre.com/connect/token', [
            'code' => $request['code'],
            'scope' => $request['scope'],
            'session_state' => $request['session_state'],
            'client_id' => 'robotel_web',
            'client_secret' => 'robotel_web',
            'code_challenge' => 'l0gl43mF9SzmCdttZQaKWKERf1VyRMC0CdPPbz1E8no',
            'code_challenge_method' => 'S256',
            'response_type' => 'code',
            'grant_type' => 'authorization_code',
            'code_verifier' => $codeVerifier,
            'redirect_uri' => 'https://api.robotel.co.th/oauth/robotel/callback',
        ]); 

        return $response->json();
        
    }


    public function redirectToProvider1(Request $request){

    //   $request->session()->put('state', $state = Str::random(40));

   /* $response = Http::get('https://siamtheatre.com/api/v1/user_control/info', [
        'content-type' => 'application/json',
        'Accept' => 'application/json',
        'Authorization' => 'Bearer '.'eyJhbGciOiJSUzI1NiIsImtpZCI6IjE5OEI5NTVGNTlENzE1RjE0QUI5QjcxQkFBQzhBMzBDMzg5MkNFMjQiLCJ0eXAiOiJhdCtqd3QiLCJ4NXQiOiJHWXVWWDFuWEZmRkt1YmNicXNpakREaVN6aVEifQ.eyJuYmYiOjE2MzMzNjAwMDgsImV4cCI6MTYzMzM2MDE4OCwiaXNzIjoibnVsbCIsImF1ZCI6IklkZW50aXR5U2VydmVyQXBpIiwiY2xpZW50X2lkIjoicm9ib3RlbF93ZWIiLCJzdWIiOiJjZTY5OTJmMi0zZGE0LTRmYjctODc2ZS1hNDA4YzRmMDIwNmYiLCJhdXRoX3RpbWUiOjE2MzMzNjAwMDcsImlkcCI6ImxvY2FsIiwic2NvcGUiOlsib3BlbmlkIiwicHJvZmlsZSIsIklkZW50aXR5U2VydmVyQXBpIl0sImFtciI6WyJwd2QiXX0.wkJtT09L1DjmuPFi_3pbYNMd0SZn9EocTfJY23y7jobi-lXMqrlIQVxfEBXTzBipPKWQ6n_zAiHrZCz2p3QyPfOq6It1wrGowXGnMrUPZdf6__zcoNjGsSamtdhQvxNNrdnBvtkruS2HiQfrnxJEH-evJTz2vFIxYogqs2okdsR8Fpmu6apoAkscihRooEB3D3tYd_Eos3N_NXhP8NVadI-ho6gMnSWH3RdNfpwBkqlchUIygPHULmW7PP8Y2lLnPCdNNXEwuLDPHi-QX9bAPJLlgQzfqv_HxOoMkSpJDdixzUKYStTgS_PSx8vtux57CMastZelbmxxEQbfkjKvEw',
    ]); */


    
  //  return $response->json();
   // $data['data_token'] = $token;


       $request->session()->put(
        'code_verifier', $code_verifier = Str::random(128)
       );

    $codeChallenge = strtr(rtrim(
        base64_encode(hash('sha256', $code_verifier, true))
    , '='), '+/', '-_');

       $data['codeChallenge'] = $codeChallenge;

       return view('home', $data);

    }
}
