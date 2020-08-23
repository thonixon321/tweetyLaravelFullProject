<x-app>
<form method="POST" action="{{ $user->path() }}" enctype="multipart/form-data">
    @csrf 
    @method('PATCH')

    <div class="mb-4">
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
            Name
        </label>
    <input type="text" name="name" id="name" value="{{ $user->name }}" class="border border-gray-400 p-2 w-full" required>

        @error('name')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="username">
            Username
        </label>
        <input type="text" name="username" id="username" value="{{ $user->username }}" class="border border-gray-400 p-2 w-full" required>

        @error('username')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="avatar">
            Avatar
        </label>
        <input type="file" name="avatar" id="avatar" class="border border-gray-400 p-2 w-full">

        @error('avatar')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">
            Email
        </label>
        <input type="email" name="email" id="email" class="border border-gray-400 p-2 w-full"  value="{{ $user->email }}" required>

        @error('email')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">
            Password
        </label>
        <input type="password" name="password" id="password" class="border border-gray-400 p-2 w-full" required>

        @error('password')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password_confirmation">
            Password Confirmation
        </label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="border border-gray-400 p-2 w-full" required>

        @error('password_confirmation')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
            Submit
        </button>
    </div>
</form>
</x-app>