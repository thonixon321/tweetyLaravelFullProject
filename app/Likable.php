<?php

namespace App;

trait Likable {

    //lets you dynamically build queries, for example Tweet::all() will return basic attributes of tweets, this function will allow you to call Tweet::withLikes()->get() and give tweets including the number of likes and dislikes - this is seen in the User model in the timeline method, we get all the tweets withLikes() which uses this query to connect to likes table and get the sum of likes and dislikes
    public function scopeWithLikes($query)
    {
        //basically reproduce the following mysql query with eloquent
        // select * from tweets
        // left join (
        //     select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id
        // ) likes on likes.tweet_id = tweet.id

        //now eloquent - arguments are the subquery, likes table, and first result where likes.tweet_id = tweet.id
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }

    public function like($user = null, $liked = true)
    {
        //updateOrCreate works better than create here since the likes table will only allow for one record on a user_id, tweet_id. So if a record already exists for a user liking or disliking a certain tweet, this will allow that record to update
        $this->likes()->updateOrCreate(
        [
            'user_id' => $user ? $user->id : auth()->id()
        ],
        [
            'liked' => $liked
        ]
        );
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }
    //can check a tweet to see if it was liked by a particular user you pass in (returns true or false)
    public function isLikedBy(User $user)
    {
        return (bool) $user->likes->where('tweet_id', $this->id)
                        ->where('liked', true)
                        ->count();
    }

    public function isDislikedBy(User $user)
    {
        return (bool) $user->likes
                        ->where('tweet_id', $this->id)
                        ->where('liked', false)
                        ->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}