<x-app-layout>
    <div id="app">
        <uploader :model_id="{{ $gallery->id }}" model="{{ $gallery->getModelName() }}"></uploader>
    </div>
</x-app-layout>
