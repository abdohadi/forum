@component('profiles.activities.activity')
    @slot('heading')
        <strong>{{ $profileUser->name }}</strong> published 
        <a href="{{ $activity->subject->route() }}">
            <h3 class="font-bold inline">"{{ $activity->subject->title }}"</h3>
        </a>
    @endslot

    @slot('body')
        <div class="mt-4">{{ $activity->subject->body }}</div>
    @endslot
@endcomponent
