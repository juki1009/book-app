<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bookshelf — 読書記録</title>
        <link rel="icon" type="image/png" href="{{ asset('images/reading_cat_2.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            /* カスタムスタイル */
        </style>
    </head>

    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-white min-h-screen flex items-center justify-center">
        {{-- ナビゲーション --}}
        <nav class="flex flex-col gap-5 md:gap-10">
            <a href="/" class="text-center">
                <div class="flex justify-center">
                    <img src="{{ asset('images/reading_cat_2.png') }}" alt="Bookshelf" class="w-60">
                </div>
                <div class="text-4xl font-serif">Bookshelf</div>
                <div class="text-sm">- 読書記録 -</div>
            </a>
    
            <div class="text-center border border-gray-700 rounded px-8 py-10 mx-4 sm:px-24 sm:mx-0">
                <div class="text-2xl font-serif mb-5">ログイン</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="flex flex-col gap-1 mb-5">
                        <label for="" class="text-left">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="bg-black border border-white/30 rounded-sm px-3 py-1 text-white w-full">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="" class="text-left">パスワード</label>
                        <input type="password" name="password" required class="bg-black border border-white/30 rounded-sm px-3 py-1 text-white w-full">
                    </div>

                    @if ($errors->any())
                        <p class="text-red-400 text-sm text-left">メールアドレスまたはパスワードが正しくありません。</p>
                    @endif

                    <button type="submit" class="w-full bg-[#D8BF8F] text-black p-2 rounded-sm font-medium hover:bg-white/80 transition mt-5">
                        ログイン
                    </button>
                </form>
                <div class="flex justify-center gap-1 text-gray-400 text-sm mt-5">
                    <p>アカウントをお持ちでない方は</p>
                    <a href="{{ route('register') }}" class="underline">新規登録</a>
                </div>
            </div>
        </nav>
    </body>
</html>
