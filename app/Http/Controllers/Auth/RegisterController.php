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
                'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
                'password_confirmation' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|same:password'
            ], [
                'username.required' => '※ユーザー名を入力してください。',
                'username.min' => '※ユーザー名は2文字以上で入力してください。',
                'username.max' => '※ユーザー名は12文字以内で入力してください。',
                'mail.required' => '※メールアドレスを入力してください。',
                'mail.email' => '※メールアドレスの形式が正しくありません。',
                'mail.unique' => '※このメールアドレスは既に登録されています。',
                'mail.min' => '※メールアドレスは5文字以上で入力してください。',
                'mail.max' => '※メールアドレスは40文字以内で入力してください。',
                'password.required' => '※パスワードを入力してください。',
                'password.regex' => '※パスワードは英数字（半角）で入力してください。',
                'password.min' => '※パスワードは8文字以上で入力してください。',
                'password.max' => '※パスワードは20文字以内で入力してください。',
                'password_confirmation.required' => '※パスワード確認を入力してください。',
                'password_confirmation.regex' => '※パスワード確認は英数字（半角）で入力してください。',
                'password_confirmation.min' => '※パスワード確認は8文字以上で入力してください。',
                'password_confirmation.max' => '※パスワード確認は20文字以内で入力してください。',
                'password_confirmation.same' => '※パスワードとパスワード確認が一致していません。',



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
