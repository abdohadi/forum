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