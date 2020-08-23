<x-app>
   <header class="mb-6 relative">
       <img class="w-full h-32 mb-2" src="/images/default-image.png" alt="default banner">
       <div class="flex justify-between items-center mb-4">
           <div>
             <h2 class="text-2xl font-bold mb-0">{{ $user->name}}</h2>  
           <p class="text-sm"> Joined {{ $user->created_at->diffForHumans() }}</p>
           </div>

           <div class="flex">
               @can ('edit', $user)
           <a href="{{ $user->path('edit') }}" class=" rounded-full border border-gray-300 mr-2 py-2 px-4 text-black text-xs">Edit Profile</a>
               @endcan
           @if (current_user()->isNot($user))
           <form method="POST" action="{{ route('follow', $user->username) }}">
                @csrf
                <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-4 text-white text-xs">
                {{ auth()->user()->following($user) ? 'Unfollow me' : 'Follow Me' }}
                </button>
           </form>
           @endif
           </div>
       </div>
       <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus aut, quia molestiae perspiciatis provident pariatur quaerat natus illum. Doloribus fuga ducimus possimus ipsa debitis ab, similique laudantium alias repellendus. Odio!</p>
       <img style="width: 150px; top: 30px; left: calc(50% - 75px)" src="{{$user->avatar}}" alt="person" class="rounded-full mr-2 absolute">
    
   </header>

    @include ('_timeline', [
        'tweets' => $tweets
    ])

</x-app>