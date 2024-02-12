@extends('layout.admin')

@section('title',  isset($comment) ? "Редактировать комментарий ID {$comment->id}" : 'Добавить комментарий')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ isset($comment) ? "Редактировать комментарий ID {$comment->id}" : 'Добавить комментарий' }}</h3>

        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" method="POST"
                  action="{{ isset($comment) ? route("admin.comments.update", $comment->id) : route("admin.comments.store") }}">
                @csrf

                @if(isset($comment))
                    @method('PUT')
                @endif

                <label class="block">
                    <span class="text-gray-700">Выберите пользователя:</span>
                    <select name="user_id"
                            class="block w-full mt-1 rounded-md py-3 @error('text') border-red-500 @enderror">
                        @foreach ($users as $id => $user)
                            <option value="{{ $id }}" @if(isset($comment))
                                {{ $id == $comment->user_id ? 'selected' : ''  }}
                                @endif>
                                {{ $user }}
                            </option>
                        @endforeach
                    </select>
                </label>

                @error('user_id')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label class="block">
                    <span class="text-gray-700">Заголовок поста:</span>
                    <select required="required" name="post_id"
                            class="block w-full mt-1 rounded-md py-3 @error('text') border-red-500 @enderror">
                        @foreach ($posts as $id => $post)
                            <option value="{{ $id }}" @if(isset($comment))
                                {{ $id == $comment->post_id ? 'selected' : ''  }}
                                @endif>
                                {{ $post }}
                            </option>
                        @endforeach
                    </select>
                </label>

                @error('post_id')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
                <textarea id="text" name="text" rows="4"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('text') border-red-500 @enderror"
                          placeholder="Напишите здесь описание...">{{ $comment->text ?? '' }}</textarea>

                @error('text')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
@endsection
