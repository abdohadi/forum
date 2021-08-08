<x-app-layout>
    <div class="w-8/12 m-auto">
        <div class="mx-20">
            <div class="py-10 flex items-end" style="box-shadow: 0px 5px 2px -5px #aaa;">
                <h2 class="text-xl text-3xl text-5xl text-gray-500 mr-4">
                    {{ $profileUser->name }}
                </h2>
                <small class="text-xl text-gray-500">Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </div>
        </div>

        <div class="py-12 flex">
            <div class="max-w-7xl sm:px-6 lg:px-8 w-full">
                @foreach ($threads as $thread)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-300">
                        <div class="p-6 bg-white border-b border-gray-200 flex">
                            <article class="py-4 w-full">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <a class="mb-2" href="#">{{ $thread->creator->name }}</a> posted:
                                        <h3 class="font-bold text-lg mb-2 inline">{{ $thread->title }}</h3>
                                    </div>

                                    <h3 class="text-sm text-gray-500">{{ $thread->created_at->diffForHumans() }}</h3>
                                </div>
        
                                <div class="mt-4">{{ $thread->body }}</div>
                            </article>
                        </div>
                    </div>
                @endforeach

                {{ $threads->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
