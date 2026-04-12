<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            書籍一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('books.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                    ＋ 書籍を登録
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($books->isEmpty())
                        <p class="text-gray-500">まだ書籍が登録されていません。</p>
                    @else
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b">
                                    <th class="py-2 px-4">タイトル</th>
                                    <th class="py-2 px-4">著者</th>
                                    <th class="py-2 px-4">評価</th>
                                    <th class="py-2 px-4">読了日</th>
                                    <th class="py-2 px-4">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-2 px-4">
                                            <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:underline">
                                                {{ $book->title }}
                                            </a>
                                        </td>
                                        <td class="py-2 px-4">{{ $book->author ?? '－' }}</td>
                                        <td class="py-2 px-4">{{ $book->rating ? str_repeat('★', $book->rating) : '－' }}</td>
                                        <td class="py-2 px-4">{{ $book->read_at ?? '－' }}</td>
                                        <td class="py-2 px-4 flex gap-2">
                                            <a href="{{ route('books.edit', $book) }}" class="text-yellow-600 hover:underline">編集</a>
                                            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('削除しますか？')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>