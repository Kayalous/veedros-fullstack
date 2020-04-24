<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\LoginVerificationMail;
use App\Mail\WelcomeVerificationMail;
use App\Providers\RouteServiceProvider;
use App\SocialProvider;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(User::where('email' ,$data['email'])->count() !== 0){
            \Session::flash('message',"You already have an account. Try logging in instead.");
            \Session::flash('login-form',"");
            \Session::flash('email-sendback', $data['email']);
        }

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable','string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $nameFromEmail = explode("@",$data['email']);
        $nameFromEmail = $nameFromEmail[0];

        if($data['password'] != null)
        $user =  User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $nameFromEmail,
            'verificationToken' => Str::random(50),
        ]);
        else
            $user = User::create([
                'email' => $data['email'],
                'name' => $nameFromEmail,
                'verificationToken' => Str::random(50),
            ]);

        Mail::to("$user->email")->send(new WelcomeVerificationMail($user));

        if($this->getEmailProvider($data['email']) !== 'unknown')
            \Session::flash('inbox-link', $this->getEmailProvider($data['email']));

        \Session::flash('success','Welcome to Veedros! A link to verify your account was sent to you at ' . $data['email']);
        return $user;

    }
    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProviderFacebook()
    {
        Session::put('url.intended', url()->previous());
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackFacebook()
    {

            $socialUser = Socialite::driver('facebook')->stateless()->user();
            //Check if it's the first time logging in
            $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();
            if(!$socialProvider){
                //Prepare image
                $url = explode('?', $socialUser->getAvatar());
                $url = $url[0] . '?type=large';
                //Download and store image
                $contents = file_get_contents($url);
                $name = time() . '.' . 'jpeg';
                Storage::disk('profileImages')->put($name, $contents);
                //retrieve image
                $image = Storage::disk('profileImages')->get($name);
                $file = new \Illuminate\Http\File(public_path('uploads/profilePictures'). '/' . $name);
                //upload to amazon
                $fileUrl = Storage::disk('s3')->put('users/profile-images', $file);
                $fileUrl = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $fileUrl;
                //delete image from local storage
                Storage::disk('profileImages')->delete($name);
                //set image url
                $request['img'] = $fileUrl;
                //Create a new user
                $user = User::firstOrcreate(
                    ['email' => $socialUser->getEmail()],
                    ['name' => $socialUser->getName(),
                        'verificationToken' => null,
                        'email_verified_at' => Carbon::now()->toDateTimeString(),
                        'img'=> $request['img'],
                    ]);
                //Create a new socialProvider
                $user->socialProviders()->create(
                    ['provider_id'=> $socialUser->getId(),
                        'provider'=>'facebook']);
            }
            else{
                //The user already exists, get that one!
                $user = $socialProvider->user;
            }
            //Log the user in
            Auth::login($user);
        if(Session::get('url.intended'))
            return redirect(Session::get('url.intended'));
        return redirect('/dashboard');
        }


    public function getEmailProvider($email){
        //Try to guess the user's email provider to get a link to their inbox.
        $emailProvider = explode("@",$email)[1];
        $emailProvider = explode('.', $emailProvider)[0];

        //gmail
        if($emailProvider == 'gmail')
            return 'mail.google.com/mail/';
        //yahoo
        if ($emailProvider == 'yahoo'){
            return 'mail.yahoo.com/mb/';
        }

        return 'unknown';
    }




    /**
     * Redirect the user to the google authentication page.
     *
     */
    public function redirectToProviderGoogle()
    {
        Session::put('url.intended', url()->previous());
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackGoogle()
    {
            $socialUser = Socialite::driver('google')->stateless()->user();
            //Check if it's the first time logging in
            $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();

            if(!$socialProvider){
                //Prepare image
                $url =$socialUser->getAvatar();
                //Download and store image
                $contents = file_get_contents($url);
                $name = time() . '.' . 'jpeg';
                Storage::disk('profileImages')->put($name, $contents);
                //retrieve image
                $image = Storage::disk('profileImages')->get($name);
                $file = new \Illuminate\Http\File(public_path('uploads/profilePictures'). '/' . $name);
                //upload to amazon
                $fileUrl = Storage::disk('s3')->put('users/profile-images', $file);
                $fileUrl = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $fileUrl;
                //delete image from local storage
                Storage::disk('profileImages')->delete($name);
                //set image url
                $request['img'] = $fileUrl;
                //Create a new user
                $user = User::firstOrcreate(
                    ['email' => $socialUser->getEmail()],
                    ['name' => $socialUser->getName(),
                        'verificationToken' => null,
                        'email_verified_at' => Carbon::now()->toDateTimeString(),
                        'img'=> $request['img'],
                    ]);
                //Create a new socialProvider
                $user->socialProviders()->create(
                    ['provider_id'=> $socialUser->getId(),
                        'provider'=>'google']);
            }
            else{
                //The user already exists, get that one!
                $user = $socialProvider->user;
            }
            //Log the user in
            Auth::login($user);
        if(Session::get('url.intended'))
            return redirect(Session::get('url.intended'));
        return redirect('/dashboard');
        }
}
