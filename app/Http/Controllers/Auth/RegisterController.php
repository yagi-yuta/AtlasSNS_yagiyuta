<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {   //0715バリデーション追記
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|min:2|max:12',
                'mail' => 'required|email|unique:users,mail|min:5|max:40',
                'password' => 'required|alpha_num|min:8|max:20',
                'password_confirmation' => 'required|alpha_num|min:8|max:20|same:password',
            ]);

            //バリデーション失敗時の処理
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect()->route('added')->with('username', $username);
        }
        return view('auth.register');
    }

    public function added(Request $request)
    {
        $username = $request->session()->get('username', 'ゲスト');
        return view('auth.added', ['username' => $username]);
    }
}
