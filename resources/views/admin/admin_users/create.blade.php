@extends('layout.admin')

@section('title',  isset($admin_user) ? "Редактировать пользователя ID {$admin_user->id}" : 'Добавить пользоваетеля')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ isset($admin_user) ? "Редактировать пользователя ID {$admin_user->id}" : 'Добавить пользоваетеля' }}</h3>

        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" method="POST"
                  action="{{ isset($admin_user) ? route("admin.admin_users.update", $admin_user->id) : route("admin.admin_users.store") }}">
                @csrf

                @if(isset($admin_user))
                    @method('PUT')
                @endif

                <input name="name" type="text"
                       class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-500 @enderror"
                       placeholder="Имя" value="{{ $admin_user->name ?? '' }}"/>

                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="text"
                       class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror"
                       placeholder="Email" value="{{ $admin_user->email ?? '' }}"/>

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="text"
                       class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror"
                       placeholder="Пароль" value="{{ $admin_user->password ?? Hash::make(Str::random(10)) }}"/>

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
