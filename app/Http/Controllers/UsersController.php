<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Follow;

use App\User;
class UsersController extends Controller
{
    //
    public function profile()
    {
        $username = Auth::user()->username;
        $mail = Auth::user()->mail;
        $bio = Auth::user()->bio;
        $images = Auth::user()->images;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;
        return view('users.profile', compact('username', 'mail', 'bio', 'images', 'followCount', 'followerCount'));
    }
    public function search()
    {
        $query = isset($_POST['search']) ? $_POST['search'] : '';
        //フォームから送信されたデータを取得し、変数 $query に代入



        $users = DB::table('users')
            ->where('username', 'like', '%' . $query . '%')
            ->get();



        $following = DB::table('follows') //フォローしてるかしてないか確認
            ->where('following_id', Auth::id())
            ->pluck('followed_id')
            ->toArray();


        $username = Auth::user()->username;
        $images = Auth::user()->images;
        $bio = Auth::user()->bio;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;

        return view('users.search', compact('users', 'username', 'images', 'bio', 'following', 'query', 'followCount', 'followerCount'));
    }

    public function editProfile(Request $request)
    {

        //バリデーション
        $validate = $request->validate([
            'username' => 'required|min:2|max:12',
            'mail' => ['required', 'min:5', 'max:40', 'email', Rule::unique('users', 'mail')->ignore(Auth::id())],
            'new_password' => 'nullable|alpha_num|min:8|max:20',
            'new_password_confirmation' => 'nullable|alpha_num|min:8|max:20|same:new_password',
            'bio' => 'max:150',
            'images' => 'nullable|image|mimes:jpg,png,gif,svg',
        ]);
        //更新
        $data = [
            'username' => $validate['username'],
            'mail' => $validate['mail'],
            'bio' => $validate['bio'],
        ];

        // パスワードの更新処理
        if (!empty($validate['new_password'])) {
            $data['password'] = Hash::make($validate['new_password']); // ハッシュ化
        }

        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);
            $data['images'] = $imageName;
        }

        DB::table('users')
            ->where('id', Auth::id())
            ->update($data);

        $username = Auth::user()->username;
        $mail = Auth::user()->mail;
        $bio = Auth::user()->bio;
        $images = Auth::user()->images;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;

        return redirect()->route('top');
    }
    public function followProfile($id)
    {

        $user = User::find($id);//http://127.0.0.1:8000/users/profile/(他ユーザーのID)　他のユーザー情報を取得するための文
        $posts = $user->posts;
        $username = Auth::user()->username;
        $mail = Auth::user()->mail;
        $bio = Auth::user()->bio;
        $images = Auth::user()->images;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;


        $following = DB::table('follows') //フォローしてるかしてないか確認
            ->where('following_id', Auth::id())
            ->pluck('followed_id')
            ->toArray();



        return view('users.followProfile', compact('user', 'username', 'posts', 'mail', 'bio', 'images', 'followCount', 'followerCount', 'following'));
    }


}
