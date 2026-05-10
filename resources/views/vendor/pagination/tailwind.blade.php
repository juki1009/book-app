@if ($paginator->hasPages())
    <nav class="flex items-center gap-1">

        {{-- 前のページ --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-600 text-sm cursor-not-allowed">＜</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-1 text-gray-400 text-sm hover:text-white transition duration-200">＜</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-600 text-base">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-[#D8BF8F] text-black text-base rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1 text-gray-400 text-base rounded hover:bg-gray-800 hover:text-white transition duration-200">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- 次のページ --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1.5 text-gray-400 text-sm hover:text-white transition duration-200">＞</a>
        @else
            <span class="px-3 py-1.5 text-gray-600 text-sm cursor-not-allowed">＞</span>
        @endif

    </nav>
@endif