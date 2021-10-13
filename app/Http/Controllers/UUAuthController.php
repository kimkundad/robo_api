<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;

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

     //   return $response->json();

     $response1 = Http::withToken($response['access_token'])->get('https://siamtheatre.com/api/v1/user_control/info');

     $user = User::where('email', $response1['email'])->first();

     if( $user ) {

        $user->update([
            'access_token' => $response['access_token']
        ]);
        $user = Auth::guard('api')->login($user, true);
      // $user = Auth::login($user, true);
       // dd($user);
      //  return redirect()->intended('https://www.robotel.co.th/get_api/socialauth?id='.$user);
      return redirect()->intended('https://www.robotel.co.th/get_api/Items?id='.$user.'&tokenme='.$response['access_token']);

     }else{

        $randomSixDigitInt = 'RBT-'.(\random_int(10000, 99999)).'-'.(\random_int(10000, 99999)).'-'.(\random_int(10000, 99999));
        $ran = array("1483537975.png","1483556517.png","1483556686.png");

            $user = User::create([
                'name' => $response1['username'],
                'email' => $response1['email'],
                'first_name' => $response1['firstname'],
                'last_name' => $response1['lastname'],
                'phone' => $response1['phoneNumber'],
                'avatar' => $ran[array_rand($ran, 1)],
                'provider' => 'email',
                'provider_id' => (\random_int(100000000, 999999999)),
                'access_token' => $response['access_token'],
                'code_user' => $randomSixDigitInt,
                // user can use reset password to create a password
                'password' => ''
            ]);

            $objs = DB::table('role_user')
            ->where('user_id', $user->id)
            ->first();

            if($objs != null){

            }else{
    
              DB::table('role_user')->insert(
                  ['role_id' => 3, 'user_id' => $user->id]
              );
    
            }

            $user = Auth::guard('api')->login($user, true);

            
        
            return redirect()->intended('https://www.robotel.co.th/get_api/Items?id='.$user.'&tokenme='.$response['access_token']);

     }
     

        
    }


    public function redirectToProvider1(Request $request){

    //   $request->session()->put('state', $state = Str::random(40));

    
  //  $response = Http::withToken('eyJhbGciOiJSUzI1NiIsImtpZCI6IjE5OEI5NTVGNTlENzE1RjE0QUI5QjcxQkFBQzhBMzBDMzg5MkNFMjQiLCJ0eXAiOiJhdCtqd3QiLCJ4NXQiOiJHWXVWWDFuWEZmRkt1YmNicXNpakREaVN6aVEifQ.eyJuYmYiOjE2MzMzNjIxMjcsImV4cCI6MTYzMzM2MjMwNywiaXNzIjoibnVsbCIsImF1ZCI6IklkZW50aXR5U2VydmVyQXBpIiwiY2xpZW50X2lkIjoicm9ib3RlbF93ZWIiLCJzdWIiOiJjZTY5OTJmMi0zZGE0LTRmYjctODc2ZS1hNDA4YzRmMDIwNmYiLCJhdXRoX3RpbWUiOjE2MzMzNjIxMjcsImlkcCI6ImxvY2FsIiwic2NvcGUiOlsib3BlbmlkIiwicHJvZmlsZSIsIklkZW50aXR5U2VydmVyQXBpIl0sImFtciI6WyJwd2QiXX0.kG8IgNc7wsWAFa_rq_zXFB-E16TrhPSMknBi-UrNpdHeuFsdo9AznE7LfDrgxvZkCghdUuNEy6v_ckcWzONdYYPyEKW8qh9oegq4z6-i9ZssC0RvN2M7TVL4cAcC6wC76ZeQFTMvIlXs4mXHCK8kuddYQw_R01L5mAwmnPaOsvQ5Sw1GCqq9xpoWFSNxJJ3aS9RfGmKkPIVK2YZnLcHhyeUJHDsywyBK7Qb5e8jP4lA8bOqhjD7-oZq9mkIsyviS9SOmbokATVhswGnCnScVP3FgQyqLost5Zmun8ZSrN_8Sl3OL0usowq3J2mduGnNHCdmMBJHlEs5TA0iATkESbA')->get('https://siamtheatre.com/api/v1/user_control/info');
    
     //   return $response->json();
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
