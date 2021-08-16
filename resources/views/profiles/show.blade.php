<x-app-layout>
    <div class="w-8/12 m-auto">
        <div class="mx-20">
            <div class="py-10 flex items-end" style="box-shadow: 0px 5px 2px -5px #aaa;">
                <h2 class="text-5xl text-gray-500 mr-4">
                    {{ $profileUser->name }}
                </h2>
            </div>
        </div>

        <div class="py-12 flex">
            <div class="max-w-7xl sm:px-6 lg:px-8 w-full">
                @foreach ($activities as $date => $records)
                    <div class="mb-10">
                        <h2 class="text-gray-500 mr-4 text-xl border-b pb-2 mb-5">
                            {{ $date }}
                        </h2>

                        @foreach ($records as $activity)
                            @if (view()->exists("profiles.activities.{$activity->type}"))
                                @include("profiles.activities.{$activity->type}")
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
