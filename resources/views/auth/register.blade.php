<x-guest-layout>
    <div class="text-center mb-5">
        <h1 class="text-2xl font-serif mb-1">新規ユーザー登録</h1>
        <p class="text-sm">アカウントを作成して読書記録を始めましょう</p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('ユーザー名')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="ユーザー名を入力" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="メールアドレスを入力" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="パスワードを入力" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード（確認）')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="パスワードを再入力" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-3 mt-4">
            <button type="submit" class="w-full bg-[#D8BF8F] text-black p-2 rounded-sm font-medium hover:bg-white/80 transition mt-5">登録する</button>
            <p class="text-sm text-center">
                すでにアカウントをお持ちの方は
                <a href="{{ url('/') }}" class="text-[#D8BF8F]">ログイン</a>
            </p>
        </div>
    </form>
</x-guest-layout>
