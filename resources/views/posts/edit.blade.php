<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="title" class="block font-medium text-sm text-gray-700">Titulo</label>
                    <input type="text" class="form-input w-full rounded-md shadow-sm" name="title" value="{{ $post->title }}">

                    <label for="body" class="block font-medium text-sm text-gray-700">Contenido</label>
                    <textarea class="form-input w-full rounded-md shadow-sm" name="body">{{ $post->body }}</textarea>

                    <hr class="my-4">

                    <input type="submit" value="Actualizar" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
