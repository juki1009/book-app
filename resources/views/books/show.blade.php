<x-app-layout>
    <div class="py-12 px-10 max-w-3xl mx-auto">
        <div class="mb-5">
            <a href="{{ route('books.index') }}" class="text-[#D8BF8F] text-lg hover:underline">
                ← 一覧に戻る
            </a>
        </div>
        <div class="mx-auto flex flex-col items-center md:items-start justify-center md:flex-row gap-8">
            <div class="flex-shrink-0 w-60">
                <div class="w-full aspect-[2/3] border border-white/30 rounded overflow-hidden flex items-center justify-center text-white text-xs text-center">
                    @if ($book->thumbnail)
                        <img src="{{ $book->thumbnail }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                    @else
                        <span>表紙画像<br>（書籍検索時に自動取得）</span>
                    @endif
                </div>
            </div>

            <div class="flex-1 min-w-0">
                <div class="">
                    <div class="overflow-hidden space-y-4 text-white">
                        <div class="font-bold text-2xl">{{ $book->title }}</div>
                        <div class="text-base">{{ $book->author ?? '－' }}</div>
                        <div class="flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= ($book->rating ?? 0) ? 'text-[#D8BF8F]' : 'text-gray-700' }}">★</span>
                            @endfor
                        </div>
                        <div class="text-base"><span class="">読了日：</span>{{ $book->read_at?->format('Y/m/d') ?? '－' }}</div>
                        <div>
                            <span class="font-bold text-base">あらすじ</span>
                            <p class="mt-1 text-white text-sm">{{ $book->description ?? '－' }}</p>
                        </div>
                        <div>
                            <span class="font-bold">感想</span>
                            <p class="mt-1 text-white text-sm">{{ $book->review ?? '－' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <a href="{{ route('books.edit', $book) }}" class="bg-[#D8BF8F] text-black px-6 py-2 rounded text-base hover:opacity-80 transition duration-200">
                編集
            </a>
        </div>
    </div>
</x-app-layout>