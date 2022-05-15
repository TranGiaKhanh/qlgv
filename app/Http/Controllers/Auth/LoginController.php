<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\User\UserRepositoryInterface;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        $this->middleware('guest')->except('logout');
    }

    public function showFormLogin()
    {
        return view('pages.login');
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $login = [
            'email' => $email,
            'password' => $password
        ];
        if (Auth::attempt($login)) {
                if (Auth::user()->role->name == config('const.ROLE.EMPLOYEE')) {
                    return redirect()->route('profile');
                }
                return redirect()->route('users.index');
        } else {
            return back()->with('error', 'Sai email hoặc password mời nhập lại !');;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showFormChangePassword()
    {
        return view('pages.change-password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $id = Auth::user()->id;
        $currentPassword = $user->password;
        if (Hash::check($request->currentPassword, $currentPassword)) {
            $data['password'] = Hash::make($request->newPassword);
            $data['first_login'] = config('const.NOTFIRSTLOGIN');
            $this->user->update($data, $id);
            return redirect()->route('homes.logout');
        }
        return redirect()->back();
    }
}
