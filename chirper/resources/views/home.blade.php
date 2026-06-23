<!-- The 'layout' suffix corresponds to the Blade layout at ./components/ -->
<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

        <div class="space-y-4 mt-8">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @empty
                <p class="text-gray-500">No chirps yet. Be the first to create a chirp!</p>
            @endforelse
        </div>
    </div>
</x-layout>
