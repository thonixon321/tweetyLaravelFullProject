<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tweets = Tweet::latest()->get();

        return view('tweets.index', [
            'tweets' => auth()->user()->timeline() //we only want to display the tweets for this particular user (not all tweets in DB) - which would be their own tweets and their friends/following'
        ]);
    }

    public function store()
    {
        $attributes = request()->validate(['body' => 'required|max:255']); //this validate saves as an array so we can do $attributes['body'] later in this var

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']
        ]);

        return redirect(route('home'));
    }

    public function destroy($tweet)
    {
      
        Tweet::where('id', $tweet)->firstOrFail()->delete();

        return redirect(route('profile', auth()->user()));
    }
}
