<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class UUAuthController extends Controller
{
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
