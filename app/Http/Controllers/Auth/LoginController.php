<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    /**
     * Get the login username to be used by the controller.
     *
     *@param  Request  $request
     *
     * @return string
     */
    public function findUsername()
    {

        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    public function login(Request $request)
    {
        $this->username = $this->findUsername();
        // Validation Form
        $this->validate($request, [
            'username' => 'required',
            'password' => 'min:6|required',
        ]);
        $remember = isset($request->remember) ? true : false;

        if (Auth::viaRemember()) {
            return redirect()->route('admin.home')->with(['success' => 'Chào mừng ' . Auth::user()->fullname]);
        }

        if (Auth::attempt([$this->username => $request->username, 'password' => $request->password], $remember)) {

            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home')->with(['success' => 'Chào mừng ' . Auth::user()->fullname]);
            } else {
                return redirect()->route('home')->with(['success' => 'Chào mừng ' . Auth::user()->fullname]);
            }
        }

        return back()->withInput()->withErrors(['fail' => ['Thông tin đăng nhập sai!']]);
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

}