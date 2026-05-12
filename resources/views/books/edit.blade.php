<x-app-layout>
    <div class="py-12 mx-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="{{ route('books.show', $book) }}" class="text-[#D8BF8F] text-lg hover:underline">
                    ← 戻る
                </a>
            </div>
            <h1 class="text-3xl font-bold text-[#D8BF8F]">書籍を編集</h1>
            <div class="overflow-hidden">
                {{-- メインの更新フォーム --}}
                <form id="update-form" action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('books._form')

                    <div class="mt-8 flex items-center justify-end gap-6">
                        {{-- 削除ボタン（formタグの外にあるdelete-formとIDで紐付け） --}}
                        <button type="submit" form="delete-form" class="text-red-500 text-sm hover:underline">
                            この書籍を削除する
                        </button>

                        {{-- 更新ボタン --}}
                        <button type="submit" class="w-30 md:w-auto bg-[#D8BF8F] px-5 py-2 rounded hover:opacity-50 text-black">
                            更新する
                        </button>
                    </div>
                </form>

                {{-- 削除用のフォーム（単独で定義し、表示は隠す） --}}
                <form id="delete-form" action="{{ route('books.destroy', $book) }}" method="POST"
                    onsubmit="return confirm('本当に削除しますか？')" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>