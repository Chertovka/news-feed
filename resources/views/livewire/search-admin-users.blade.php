@php
    function toggleOrder($column) {
        return Request()->sort === $column && Request()->order === 'asc' ? 'desc' : 'asc';
    }
@endphp

<div>
    <input type="text" wire:model.live="search" placeholder="поиск">

    <table class="min-w-full">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.admin_users.index', ['sort' => 'id', 'page' => Request()->page, 'order' => toggleOrder('id')]) }}">
                    ID </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.admin_users.index', ['sort' => 'name', 'page' => Request()->page, 'order' => toggleOrder('name')]) }}">
                    Имя
                </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.admin_users.index', ['sort' => 'email', 'page' => Request()->page, 'order' => toggleOrder('email')]) }}">
                    Email
                </a>
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50">&nbsp;</th>
        </tr>
        </thead>
        <tbody class="bg-white">
        @foreach($admin_users as $user)
            <tr wire:key="{{ $user->id }}">
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $user->id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $user->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">{{ $user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                    <a href="{{ route("admin.admin_users.edit", $user->id) }}"
                       class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                    <form action="{{ route("admin.admin_users.destroy", $user->id) }}" method="POST">
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


