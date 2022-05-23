<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\User;
use Illuminate\Support\Str;

class LoginController extends Controller {

    public function index(Request $request) {

        return view('auth.register');
    }

    public function signin(Request $request) {

        return view('home.signin');
    }

    public function signup(Request $request) {

        return view('home.signin');
    }

    public function verify(Request $request) {

        $validator = Validator::make($request->all(), [
                    'mobile' => [
                        'required',
                        'digits:10',
                    ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $isUser = User::where('mobile', $request->mobile)->first();
        if ($isUser) {
           
            $freshotp = $request->otp0.$request->otp1.$request->otp2.$request->otp3;
            if($isUser->otp == $freshotp){

            $request->merge(["password" => 123456]);
            $credentials = $request->only('mobile', 'password');
            if (Auth::attempt([ 'mobile'=> $request->mobile, 'password'  => $request->password ])) {              
              
                // Authentication passed...        
                $url = config('app.url');
        return redirect($url);
            }
           
    }else{
       $messag = "Opps!! OTP incorrect.";
       $user = $isUser;
        return view('auth.getotp')->with(compact('user','messag'));
       // return back()->with('error','Opps!! OTP incorrect.');
    }
    } 
        return redirect()->back()->withErrors("User Not Found");
    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'mobile' => [
                'required',
                'digits:10',
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
   // $otp = mt_rand(1000,9999);
   $otp= 1234;
        $url = "https://www.hellotext.live/vb/apikey.php?apikey=X1FVx6tERU3AdWEN&senderid=SUZUST&templateid=1707164984961292994&number=".$request->mobile."&message=Your%20OTP%20Verification%20Code%20is%20".$otp."%20for%20login.SUZUST";

        $crl = curl_init();
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($crl);

        if(!$response){
           die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }

        curl_close($crl);
        
    
        $user= User::where('mobile',$request->mobile)->first();
        if($user){
            $user->otp =$otp;
            if($user->save()){
                return view('auth.getotp')->with(compact('user'));
            }
        }else{
            $request->merge(["password" => 123456]);
            $request->merge(["role" => 'S']);
            $request->merge(["otp" => $otp]);
            $user = User::create(request([ 'mobile', 'password', 'role', 'otp']));
            return view('auth.getotp')->with(compact('user'));
        }
        
        return redirect()->to('/');
    }
    public function resend(Request $request,$mobile_number) {

        $user= User::where('mobile_number',$mobile_number)->first();

        if($user){

        $otp = $user->otp;
        $url = "https://www.hellotext.live/vb/apikey.php?apikey=X1FVx6tyRU3AdWEN&senderid=SUZUST&templateid=1707164984961292994&number=".$request->mobile_number."&message=Your%20OTP%20Verification%20Code%20is%20".$otp."%20for%20login.SUZUST";

        $crl = curl_init();
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($crl);
        if(!$response){
           die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($crl);     
      
                return view('auth.getotp')->with(compact('user'));
         
        }
        
        return redirect()->to('/');
    }
    public function logout() {
        auth()->logout();

        return redirect()->to('/');
    }
}