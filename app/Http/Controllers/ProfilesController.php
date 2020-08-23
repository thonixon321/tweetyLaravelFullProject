<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class ProfilesController extends Controller
{
    public function show (User $user) 
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(50)
        ]);
    }

    public function edit (User $user) 
    {
        //auth check (also in policy to check if the user is the current user - can't edit anyone else's profile)
        // if ($user->isNot(current_user())) {
        //     abort(404);
        // }
        //using policy... we can also do this in the routes file in a middleware check
        $this->authorize('edit', $user);

        return view('profiles.edit', compact('user'));
    }

    public function update (User $user)
    {
    
      $attributes = request()->validate([
            'username' => ['string', 'required', 'max:255', 'alpha_dash', Rule::unique('users')->ignore($user)], 
            'avatar' => ['file'],
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed']
        ]);
      //store in avatars directory, and store the path to this directory in the DB table here - this is using the store method which is found in filesystems and also this is storing to the public directory which is defined in the .env    
      if (request('avatar')) {
          $attributes['avatar'] = request('avatar')->store('avatars');
      }

      $this->authorize('edit', $user);
    
      $user->update($attributes);

      return redirect($user->path());
    }
}
