<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-gray font-bold py-2 px-4 rounded-md">Nuevo</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td class="border px-4 py-2">{{ $post->id }}</td>
                                <td class="border px-4 py-2">{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}">Ver</a>
                                    <a href="{{ route('posts.edit', $post->id) }}">Editar</a>
                                    <form method="post" action="{{ route('posts.destroy', $post->id) }}">
                                        @csrf
                                        @method('DELETE') 
                                        <input type="submit" value="Eliminar">   
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border px-4 py-2">
                                    No hay posts creados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
