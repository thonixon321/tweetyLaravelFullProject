<div class="border border-blue-400 rounded-lg py-6 px-8 mb-8">
    <form method="POST" action="/tweets">
        @csrf 
        <textarea name="body" class="w-full" placeholder="what's up doc?" required></textarea>
        <hr class="my-4">
        <footer class="flex justify-between">
        <img width="50" height="50" src="{{auth()->user()->avatar}}" alt="person" class="rounded-full mr-2">
            <button class="bg-blue-500 rounded-lg shadow p-2 text-white" type="submit">Tweet-a-roo!</button>
        </footer>
    </form>
    @error('body')
        <p class="text-red-500 text-sm">{{ $message }}</p> 
    @enderror
</div>