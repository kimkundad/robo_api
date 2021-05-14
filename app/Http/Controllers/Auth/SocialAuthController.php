<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Exception;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Jenssegers\Agent\Agent;
use App\logsys;

class SocialAuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected $providers = [
        'github',
        'facebook',
        'google',
        'twitter'
    ];

    public function show()
    {
        return view('auth.social');
    }

    public function redirectToProvider($driver)
    {

      //dd($driver);
        if( ! $this->isProviderAllowed($driver) ) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    public function handleProviderCallback( $driver )
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty( $user->email )
            ? $this->sendFailedResponse("No email id returned from {$driver} provider.")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
      if(Session::has('status_user') == 1){
       return redirect()->to('/shipping');
        }else{
        return redirect()->intended('/');
        }

    }
    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
            ->withErrors(['msg' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();
        
        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
            
        } else {
            // create a new user

            $randomSixDigitInt = 'RBT-'.(\random_int(10000, 99999)).'-'.(\random_int(10000, 99999)).'-'.(\random_int(10000, 99999));

            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'avatar' => $providerUser->getAvatar(),
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
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

        $agent = new Agent();

            $obj = new logsys();
            $obj->user_id = $user->id;
            $obj->detail = 'ได้ทำการเข้าสุ่ระบบเพื่อใช้งานผ่าน :'.$agent->device().' Operating system name : '.$agent->platform();
            $obj->ip_address = \Request::ip();
            $obj->browser = $agent->browser();
            $obj->status = 1;
            $obj->save();


        }

      //  dd($user);

        



        // login the user
        $user = Auth::login($user, true);
        
        return redirect()->intended('https://www.robotel.co.th/get_api/socialauth?id='.$user);
       // dd($user);

       // return $this->sendSuccessResponse();
    }

    /**
     * Check for provider allowed and services configured
     *
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver)
    {

      //dd($driver);
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
