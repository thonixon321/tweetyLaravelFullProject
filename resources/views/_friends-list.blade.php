<h3 class="font-bold text-xl mb-4">Following</h3>
<ul>
    @forelse (auth()->user()->follows as $user)
    <li class="mb-4">
        <div class=" text-sm">
            <a class="flex items-center" href="{{ route('profile', $user) }}">
        <img width="40" height="40" src="{{ $user->avatar }}" alt="person" class="rounded-full mr-2">
            {{ $user->name }}
            </a>
        </div>
    </li>
    @empty 
    <li>NO FRIENDS YET!</li>
    @endforelse
</ul>