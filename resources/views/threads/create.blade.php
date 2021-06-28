<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('threads.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="channel">Choose Channel:</label>
                            <select name="channel_id" class="form-input" required>
                                <option value="">Choose One...</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ $channel->id == old('channel_id') ? 'sellected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}" required>
                        </div>

                        <div>
                            <label for="body">Body:</label>
                            <textarea id="body" name="body" rows="7" class="form-input" required>{{ old('body') }}</textarea>
                        </div>

                        <button type="submit" class="white-btn">Publish</button>

                        @if ($errors->count())
                            <ul class="ul-errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
