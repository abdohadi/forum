<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thread') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <article class="py-4">
                        <a class="mb-2 text-blue-400" href="#">{{ $thread->creator->name }}</a> posted:
                        <h3 class="font-bold text-lg mb-2 inline">{{ $thread->title }}</h3>
                        <div>{{ $thread->body }}</div>
                    </article>
                </div>
            </div>
        </div>
    </div>

    @each ('threads._reply', $thread->replies, 'reply')

    @if (auth()->check())
        <div class="mt-3 mb-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form method="POST" action="{{ route('threads.replies.store', $thread->id) }}">
                    @csrf
                    <textarea class="form-input" name="body" placeholder="Have something to say?" rows="5"></textarea>
                    <button class="white-btn" type="submit">Add Reply</button>
                </form>
            </div>
        </div>
    @else
        <p class="text-center py-3">Please <a class="text-blue-400" href="{{ route('login') }}">sing in</a> to participate in this discussion.</p>
    @endif
</x-app-layout>
