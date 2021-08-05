<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Threads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($threads as $thread)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="py-6 px-6 bg-white">
                        <article>
                            <div class="flex border-b">
                                <h3 class="font-bold text-lg mb-2">
                                    <a href="{{ route('threads.show', [$thread->channel, $thread]) }}">{{ $thread->title }}</a>
                                </h3>

                                <strong class="ml-auto"><a href="{{ route('threads.show', [$thread->channel, $thread]) }}">{{ $thread->replies_count }} replies</a></strong>
                            </div>

                            <div class="mt-3">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
