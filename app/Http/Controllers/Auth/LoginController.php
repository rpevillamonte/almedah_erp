<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use Str;
use Hash;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }   

    public function google(){
        return Socialite::driver('google')->redirect();
    }   

    public function googleRedirect(){
        try {
            $user = Socialite::driver('google')->user();    
        } catch (\Exception $e) {
            return redirect('/login');
        }
        $existingUser = Employee::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new employee
            $newUser                  = new Employee;
            $newUser->last_name       = $user['family_name'];
            $newUser->first_name      = $user['given_name'];
            $newUser->position        = '';
            $newUser->gender          = 'Male';
            $newUser->profile_picture = $user->avatar;
            $newUser->contact_number  = '';
            $newUser->email           = $user->email;
            $newUser->active_status   = '1';
            $newUser->password        = '';
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->to('/home');
    }
}
