<!-- The 'layout' suffix corresponds to the Blade layout at ./components/ -->
<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

        <!-- Chirp Form -->
        <!-- NOTE: even if the `maxlength` and/or `required`
                   fields were omitted, the server-side will
                   return the errors as expected.
         -->
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <form method="POST" action="/chirps">
                    @csrf
                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            placeholder="What's on your mind?"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
                            required
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Chirp
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Feed -->
        <div class="space-y-4 mt-8">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @empty
                <p class="text-gray-500">No chirps yet. Be the first to create a chirp!</p>
            @endforelse
        </div>
    </div>
</x-layout>
