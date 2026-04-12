<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            書籍を編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('books._form')
                    <div class="mt-6">
                        <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-700">
                            更新する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>