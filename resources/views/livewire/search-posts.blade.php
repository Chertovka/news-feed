@php
    function toggleOrder($column) {
        return Request()->sort === $column && Request()->order === 'asc' ? 'desc' : 'asc';
    }
@endphp
<div>
    <input type="text" wire:model.live="search" placeholder="поиск">

    <table class="min-w-full">
        <thead>
        <tr>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.posts.index', ['sort' => 'id', 'page' => Request()->page, 'order' => toggleOrder('id')]) }}">
                    ID </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.posts.index', ['sort' => 'title', 'page' => Request()->page, 'order' => toggleOrder('title')]) }}">
                    Заголовок
                </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
        </tr>
        </thead>

        <tbody class="bg-white">
        @foreach($posts as $post)
            <tr wire:key="{{ $post->id }}">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $post->id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $post->title }}</div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                    <a href="{{ route("admin.posts.edit", $post->id) }}"
                       class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                    <form action="{{ route("admin.posts.destroy", $post->id) }}" method="POST">
                        @csrf

                        @method('DELETE')

                        <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
