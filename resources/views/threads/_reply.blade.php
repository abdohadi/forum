<reply v-slot="props" first-body="{{ $reply->body }}" route-to-update="{{ route('replies.update', $reply) }}">
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

                    <div>
                        <div v-if="props.editing">
                            <textarea :value="props.body" @input="event => props.onInput(event)"></textarea>

                            <div class="flex mt-2">
                                <button class="btn btn-primary mr-1 text-sm" @click="props.updateReply">Update</button>
                                <button class="btn-trans" @click="props.cancelEditing">Cancel</button>
                            </div>
                        </div>

                        <div v-else v-text="props.body"></div>
                    </div>

                    @can ('update', $reply)
                        <hr class="mt-4">

                        <div class="pt-2 flex">
                            <button class="btn-normal text-sm mr-1" @click="props.toggleEditing">Edit</button>

                            <form action="{{ route('replies.destroy', $reply) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    @endcan
                </article>
            </div>
        </div>
    </div>
</reply>
