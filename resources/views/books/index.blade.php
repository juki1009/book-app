<x-app-layout>
    <div class="py-12 mx-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">書籍一覧</h1>
                    <p class="text-sm text-gray-400 mt-1">あなたの登録した書籍一覧です</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" />
                            </svg>
                        </span>
                        <x-text-input type="text" placeholder="書籍名・著者名で検索" class="pl-9 pr-4 py-2 w-full sm:w-64 placeholder-gray-500 focus:outline-none focus:border-[#D8BF8F] text-white"
                        />
                    </div>
                    <a href="{{ route('books.create') }}" class="bg-[#D8BF8F] text-black px-4 py-2 rounded text-base hover:opacity-80 transition duration-200">
                        ＋ 書籍を登録
                    </a>
                </div>
            </div>

            <div class="overflow-hidden">
                <div class="">
                    @if ($books->isEmpty())
                        <p class="text-gray-500">まだ書籍が登録されていません。</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($books as $book)
                                <a href="{{ route('books.show', $book) }}"
                                class="group flex bg-[#1a1a1a] border border-gray-800 rounded-lg overflow-hidden hover:border-[#D8BF8F] transition duration-200 p-6">

                                    {{-- 表紙 --}}
                                    <div class="w-20 shrink-0 bg-gray-800 flex items-center justify-center rounded">
                                        {{-- TODO: あとからGoogle Books API連携 --}}
                                        <span class="text-gray-600 text-xs">No Image</span>
                                    </div>

                                    {{-- 書籍情報 --}}
                                    <div class="p-3 flex flex-col justify-between min-w-0">
                                        <div>
                                            <p class="text-white text-base line-clamp-2">
                                                {{ $book->title }}
                                            </p>
                                            <p class="text-gray-500 text-sm mt-1 truncate">
                                                {{ $book->author }}
                                            </p>
                                        </div>

                                        <div>
                                            {{-- 評価 --}}
                                            <div class="mt-2 flex items-center gap-0.5">
                                                @if ($book->rating)
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="{{ $i <= $book->rating ? 'text-[#D8BF8F]' : 'text-gray-700' }} text-sm">★</span>
                                                    @endfor
                                                @else
                                                    <span class="text-gray-600 text-xs">未評価</span>
                                                @endif
                                            </div>

                                            {{-- 登録日 --}}
                                            <p class="text-gray-500 text-sm mt-1">
                                                登録日：{{ $book->created_at->format('Y/m/d') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        @if ($books->hasPages())
                            <div class="mt-8 flex justify-center">
                                {{ $books->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>