<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Follow;
class PostsController extends Controller
{
    //
    public function index()
    {

        $userId = Auth::id();

        // フォローしているユーザーのIDを取得
        $followingIds = Follow::where('following_id', $userId)->pluck('followed_id');

        // フォローしているユーザーのポストを取得
        $posts = Post::whereIn('user_id', $followingIds)->get();

        // 自分のポストも取得
        $myPosts = Post::where('user_id', $userId)->get(); // 追加

        // すべてのポストを結合
        $posts = $posts->merge($myPosts); // 追加

        // 結合したポストを再度ソート（新しい順）
        $posts = $posts->sortByDesc('created_at');

        $username = Auth::user()->username;
        $images = Auth::user()->images;
        $bio = Auth::user()->bio;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;
        return view('posts.index', compact('posts', 'username', 'images', 'bio', 'followCount', 'followerCount', ));
    }

    //投稿機能
    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required|max:150',
        ], [
            'post.required' => '※1文字以上入力してください。',
            'post.max' => '※150文字以内で入力してください。',
        ]);

        $post = new Post;
        $post->post = $request->post;
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/top'); //TOPへリダイレクト
    }

    //削除機能
    public function destroy($id)
    {
        $post = Post::find($id);

        //投稿の所有者か確認
        if ($post && $post->user_id == Auth::id()) {
            $post->delete();
        }
        return redirect('/top');
    }

    //編集画面
    public function edit($id)
    {




        $post = post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            return redirect('/top');
        }
        return view('posts.edit', compact('post'));
    }

    //投稿を編集して更新
    public function update(Request $request, $id)
    {
        //バリデーション
        $request->validate([
            'post' => 'required|max:150',
        ], [
            'post.required' => '※1文字以上入力してください。',
            'post.max' => '※150文字以内で入力してください。',
        ]);

        //postの取得　
        $post = post::findOrFail($id);
        //　Auth::id(): 現在ログインしてるユーザー
//　if($post->user_id != Auth::id()): 投稿の所有者のID」と「今ログインしている人のID」を比較
//　!=　これは等しくないという意味
        if ($post->user_id != Auth::id()) {
            return redirect('/top');
        }





        //更新
        $post->post = $request->input('post');
        $post->save();

        return redirect('/top')->with('success', '投稿が更新');

    }

}
