<div class="flex p-4 border-b border-b-gray-400">
    <div class="mr-2 flex-shrink-0">
    <a href="{{ route('profile', $tweet->user) }}"><img width="50" height="50" src="{{$tweet->user->avatar}}" alt="person" class="rounded-full mr-2"></a> 
    </div>
    <div>
    <a href="{{ route('profile', $tweet->user) }}">
        <h5 class="mb-2 font-bold">{{$tweet->user->name}}</h5>
    </a>
    
    <p class="text-sm mb-3">{{$tweet->body}}</p>
     {{-- @if ($tweet->user()->is(auth()->user())) --}}
     <form method="POST" action="{{ route('deletetweet', $tweet) }}">
        @csrf
        @method('delete')

        <button type="submit" class="mb-2">Delete</button>

     </form>
     {{-- @endif --}}
     <x-like-buttons :tweet=$tweet />
    </div>

    
     
</div>