<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <div><span class="font-bold">著者：</span>{{ $book->author ?? '－' }}</div>
                <div><span class="font-bold">評価：</span>{{ $book->rating ? str_repeat('★', $book->rating) : '－' }}</div>
                <div><span class="font-bold">読了日：</span>{{ $book->read_at?->format('Y/m/d') ?? '－' }}</div>
                <div>
                    <span class="font-bold">あらすじ：</span>
                    <p class="mt-1 text-gray-700">{{ $book->description ?? '－' }}</p>
                </div>
                <div>
                    <span class="font-bold">感想：</span>
                    <p class="mt-1 text-gray-700">{{ $book->review ?? '－' }}</p>
                </div>
                <div class="flex gap-4 mt-4">
                    <a href="{{ route('books.edit', $book) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-400">編集</a>
                    <a href="{{ route('books.index') }}"
                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>