@component('profiles.activities.activity')
    @slot('heading')
        <strong>{{ $profileUser->name }}</strong> replied to 
        <a href="{{ route('threads.show', [$activity->subject->thread->channel, $activity->subject->thread]) }}">
            <h3 class="font-bold inline">"{{ $activity->subject->thread->title }}"</h3>
        </a>
    @endslot

    @slot('body')
        <div class="mt-4">{{ $activity->subject->body }}</div>
    @endslot
@endcomponent
