<div class="py-3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <article>
                <h3>
                    <a class="mb-2 text-blue-400" href="#">{{ $reply->owner->name }}</a> said
                    <span class="text-sm">{{ $reply->created_at->diffForHumans() }}...</span>
                </h3>
                <div>{{ $reply->body }}</div>
            </article>
        </div>
    </div>
</div>