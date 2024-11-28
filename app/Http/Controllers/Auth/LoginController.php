<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if the input is email or phone number
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'contact_number';
        $credentials = [$fieldType => $request->email, 'password' => $request->password];

        // Attempt login
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            return redirect('login')->with('error', __('Email or password is incorrect'));
        }

        // Check user status
        $user = Auth::user();

        // if ($user->status == USER_STATUS_INACTIVE) {
        //     Auth::logout();
        //     return redirect('login')->with('error', __('Your account is inactive. Please contact the admin.'));
        // }

        // if ($user->status == USER_STATUS_DELETED) {
        //     Auth::logout();
        //     return redirect('login')->with('error', __('Your account has been deleted.'));
        // }

        // if ($user->status == USER_STATUS_UNVERIFIED) {
        //     Auth::logout();
        //     return redirect('login')->with('error', __('Please verify your account before logging in.'));
        // }


        return redirect()->route('dashboard');
    }
}
