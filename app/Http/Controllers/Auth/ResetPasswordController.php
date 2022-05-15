<?php

namespace App\Http\Controllers\Auth;

use App\Mail\MailNotify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Repositories\User\UserRepositoryInterface;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function resetPassword(Request $request)
    {
        if (Gate::allows(config('const.ROLE.ADMIN'))) {
            $password = Str::random(10);
            $user = $this->user->getById($request->id);
            $data['password'] = Hash::make($password);
            $data['first_login'] = config('const.FIRSTLOGIN');
            $message = [
                'type' => 'Reset password',
                'task' => $password,
                'content' => 'Password: ',
            ];
            $this->user->update($data, $request->id);
            Mail::to($user->email)->send(new MailNotify($message));
            if(Auth::user()->id == $request->id){
                return redirect()->route('homes.logout');
            } else {
                return redirect()->route('users.index')->with('success', 'Reset mật khẩu thành công !');
            }
        } else {
            abort(403);
        }
    }
}
