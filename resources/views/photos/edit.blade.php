<x-app-layout>
    <div id="app" class="bg-gray-900 min-h-screen">
        <photos-edit :photo='@json($photo->id)' :photos='@json($photo->media)'></photos-edit>
    </div>
</x-app-layout>
