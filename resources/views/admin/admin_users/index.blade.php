@extends('layout.admin')

@section('title', 'Пользователи')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Пользователи</h3>

        <div class="mt-8">
            <a href="{{ route("admin.admin_users.create") }}" class="text-indigo-600 hover:text-indigo-900">Добавить</a>
            <p>&nbsp;</p>
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    @livewire('search-admin-users')

                    {{ $admin_users->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
