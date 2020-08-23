<?php

namespace App;


trait Followable
{
     //make functionality to let user click 'follow' on a user, and then have that update the 'follows' pivot table which shows the relation of who a user follows
     public function follow(User $user)
     {
         $this->follows()->save($user);
     }
 
     public function follows()
     {
         //a user can follow many other users - explicitly name the follows table here to get that relation because it doesn't know the name of the pivot table being used for this user class, also name the pivot table's related key and the foreign key respectively
         return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
     }
 
     //see who the user is following
     public function following(User $user)
     {
        //  //fetching an entire collection (all of what is in the follows table)
        //  return $this->follows->contains($user);
        //less taxing way to check the DB....
        return $this->follows()->where('following_user_id', $user->id)->exists();
     }

     public function unfollow(User $user)
     {
         $this->follows()->detach($user);
     }

     public function toggleFollow(User $user)
     {
        // if ($this->following($user)) {
        //     //unfollow if already following
        //   return  $this->unfollow($user);
        // } 
        //      //have auth'd user follow given user
        //    return  $this->follow($user);

        return $this->follows()->toggle($user);
        
     }
}