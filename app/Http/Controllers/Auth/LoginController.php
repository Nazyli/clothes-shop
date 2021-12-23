<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\TransUserAuthLog;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

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

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            TransUserAuthLog::createLog("SIGNIN", "SUCCESS", $request, new Agent());
            $user = auth()->user();
            if ($user->role_id == 1) {
                return redirect()->route('admin.home')->with('success', 'Selamat Datang Administrator');
            } else if ($user->role_id == 2) {
                return redirect()->route('user.home')->with('success', 'Selamat Datang '.$user->first_name.' '.$user->last_name);
            } else {
                return redirect()->route('home');
            }
        } else {
            TransUserAuthLog::createLog("SIGNIN", "FAIL", $request, new Agent());
            return redirect()->route('login')
                ->with('error', 'Incorrect email or password!');
        }
    }

    public function logout(Request $request) {
        TransUserAuthLog::createLog("SIGNOUT", "SUCCESS", $request, new Agent());
        Auth::logout();
        return redirect('/login');
      }
}
