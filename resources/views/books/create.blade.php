<x-app-layout>
    <div class="py-12 mx-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="{{ route('books.index') }}" class="text-[#D8BF8F] text-lg hover:underline">
                    ← 一覧に戻る
                </a>
            </div>
            <h1 class="text-3xl font-bold text-[#D8BF8F]">書籍一覧</h1>
            <p class="text-sm text-[#D8BF8F] mt-1">新しい書籍の情報を入力してください</p>
            <div class="overflow-hidden">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    @include('books._form')
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-[#D8BF8F] text-black px-6 py-2 rounded">
                            登録する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>