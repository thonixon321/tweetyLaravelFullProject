<x-app>
    <div>
        @foreach ($users as $user)
        <a href="{{ $user->path() }}" class="flex items-center mb-5">

            <img class="mr-4 rounded" src="{{ $user->avatar}}" alt="{{ $user->username }}'s avatar" width="60">
        <div><h4 class="font-bold">{{ '@' . $user->username }}</h4></div>
        </a>
        @endforeach
        {{-- pagination --}}
        {{ $users->links() }}
    </div>
</x-app>