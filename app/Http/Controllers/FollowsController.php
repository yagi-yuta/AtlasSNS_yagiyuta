<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Follow;
use App\User;
use App\post;
class FollowsController extends Controller
{


    public function follow($id)
    {
        $userId = Auth::id();

        // すでにフォローしていないか確認
        $isFollowing = Follow::where('following_id', $userId)
            ->where('followed_id', $id)
            ->exists();

        if (!$isFollowing) {
            // フォローを新規作成
            Follow::create([
                'following_id' => $userId,
                'followed_id' => $id,
            ]);
        }

        return redirect()->back();

    }

    public function remove_follow($id)
    {
        $userId = Auth::id();

        // フォローを削除
        Follow::where('following_id', $userId)
            ->where('followed_id', $id)
            ->delete();

        return redirect()->back();

    }

    public function followList()
    {

        $userId = Auth::id();

        $followingId = Follow::where('following_id', $userId)->pluck('followed_id');

        $followingUsers = user::whereIn('id', $followingId)->get(['id', 'username', 'images']);

        $posts = Post::whereIn('user_id', $followingId)
            ->orderBy('created_at', 'desc')
            ->get();

        $username = Auth::user()->username;
        $mail = Auth::user()->mail;
        $bio = Auth::user()->bio;
        $images = Auth::user()->images;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;
        return view('follows.followList', compact('username', 'mail', 'bio', 'images', 'followCount', 'followerCount', 'followingUsers', 'posts'));
    }
    public function followerList()
    {

        $userId = Auth::id();

        $followerId = Follow::where('followed_id', $userId)->pluck('following_id');

        $followerUsers = user::whereIn('id', $followerId)->get(['id', 'username', 'images']);

        $posts = Post::whereIn('user_id', $followerId)
            ->orderBy('created_at', 'desc')
            ->get();



        $username = Auth::user()->username;
        $mail = Auth::user()->mail;
        $bio = Auth::user()->bio;
        $images = Auth::user()->images;
        $followCount = Auth::user()->followCount;
        $followerCount = Auth::user()->followerCount;
        return view('follows.followerList', compact('username', 'mail', 'bio', 'images', 'followCount', 'followerCount', 'followerUsers', 'posts'));
    }


}
