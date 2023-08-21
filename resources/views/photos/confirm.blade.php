<x-app-layout>
    <div id="app" class="bg-gray-900">
        <photos-confirm :photo='@json($photo->id)' :photos='@json($photo->media)'></photos-confirm>
    </div>
</x-app-layout>
