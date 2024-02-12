@extends('layout.lk')

@section('title', 'Комментарии')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Комментарии</h3>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    @livewire('search-l-k-comments')

                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
