<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thread') }}
        </h2>
    </x-slot>

    <div class="py-12 flex">
        <div class="max-w-7xl sm:px-6 lg:px-8 w-4/6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10 border border-gray-300">
                <div class="p-4 bg-white">
                    <article>
                        <div class="flex items-center justify-between border-b pb-2">
                            <div>
                                <a class="mb-2" href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> posted:
                                <h3 class="font-bold text-lg mb-2 inline">{{ $thread->title }}</h3>
                            </div>

                            @can ('update', $thread)
                                <form action="{{ route('threads.destroy', $thread) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            @endcan
                        </div>

                        <div class="mt-4">{{ $thread->body }}</div>
                    </article>
                </div>
            </div>

            @each ('threads._reply', $replies, 'reply')

            {{ $replies->links() }}

            @if (auth()->check())
                <div class="mt-3 mb-8">
                    <form method="POST" action="{{ route('threads.replies.store', $thread->id) }}">
                        @csrf
                        <textarea class="form-input" name="body" placeholder="Have something to say?" rows="5"></textarea>
                        <button class="white-btn" type="submit">Add Reply</button>
                    </form>
                </div>
            @else
                <p class="text-center py-3">Please <a href="{{ route('login') }}">sing in</a> to participate in this discussion.</p>
            @endif
        </div>

        <div class="max-w-7xl sm:px-6 lg:px-8 w-2/6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-10">
                <div class="p-6 bg-white border-b border-gray-200">
                    This thread was published <span class="text-sm">{{ $thread->created_at->diffForHumans() }}</span> by <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a> and has <span class="text-sm">{{ $thread->replies_count }} comment/s</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
