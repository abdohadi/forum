<div id="reply-{{$reply->id}}" class="py-3">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <article>
                <div class="flex">
                    <h3>
                        <a class="mb-2 text-blue-400" href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a> said
                        <span class="text-sm">{{ $reply->created_at->diffForHumans() }}...</span>
                    </h3>

                    <form class="ml-auto" method="POST" action="{{ route('replies.favorite', $reply) }}">
                        @csrf 

                        <button class="{{ $reply->isFavorited() ? 'disabled' : 'white' }}-btn" type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                            <span class="text-sm">{{ $reply->favorites_count }}</span> Favorite
                        </button>
                    </form>
                </div>

                <div>{{ $reply->body }}</div>

                <hr class="mt-4">

                <div class="pt-2">
                    @can ('update', $reply)
                        <form action="{{ route('replies.destroy', $reply) }}" method="POST" class="flex justify-end">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </div>
            </article>
        </div>
    </div>
</div>