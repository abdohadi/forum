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

    @foreach ($thread->replies as $reply)
        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <article class="py-4">
                            <h3>
                                <a class="mb-2 text-blue-400" href="#">{{ $reply->owner->name }}</a> said
                                <span class="text-sm">{{ $reply->created_at->diffForHumans() }}...</span>
                            </h3>
                            <div>{{ $reply->body }}</div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
