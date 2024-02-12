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
                <a href="{{ route('admin.comments.index', ['sort' => 'id', 'page' => Request()->page, 'order' => toggleOrder('id')]) }}">
                    ID </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.comments.index', ['sort' => 'text', 'page' => Request()->page, 'order' => toggleOrder('text')]) }}">
                    Текст
                </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.comments.index', ['sort' => 'user_id', 'page' => Request()->page, 'order' => toggleOrder('user_id')]) }}">
                    Имя пользователя </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.comments.index', ['sort' => 'post_id', 'page' => Request()->page, 'order' => toggleOrder('post_id')]) }}">
                    Название поста</a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
        </tr>
        </thead>

        <tbody class="bg-white">
        @foreach($comments as $comment)
            <tr wire:key="{{ $comment->id }}">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $comment->id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $comment->text }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $comment->user->name}}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $comment->post->title}}</div>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                    <a href="{{ route("admin.comments.edit", $comment->id) }}"
                       class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                    <form action="{{ route("admin.comments.destroy", $comment->id) }}" method="POST">
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
