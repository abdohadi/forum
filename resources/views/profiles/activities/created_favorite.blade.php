@component('profiles.activities.activity')
    @slot('heading')
        <strong>{{ $profileUser->name }}</strong> favorited 
        <a href="{{ $activity->subject->favorited->route() }}">
            a reply
        </a>
    @endslot

    @slot('body')
        <div class="mt-4">{{ $activity->subject->favorited->body }}</div>
    @endslot
@endcomponent
