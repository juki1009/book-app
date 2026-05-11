<div class="flex flex-col items-center md:items-start justify-center md:flex-row md:gap-8 mt-10">
    {{-- 左カラム: 表紙エリア --}}
    <div class="flex-shrink-0 w-40">
        <div class="w-full aspect-[2/3] border border-white/30 rounded flex flex-col items-center justify-center text-white text-xs text-center p-2">
            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <span>表紙画像</span>
            <span class="mt-1">（書籍検索時に自動取得）</span>
        </div>
    </div>

    {{-- 右カラム: フォーム --}}
    <div class="flex-1 space-y-4 mt-5 md:mt-0">
        <div>
            <x-input-label for="title" :value="__('タイトル')" />
            <x-text-input id="title" class="block mt-1 w-full text-white" type="text" name="title"
                :value="old('title', $book->title ?? '')"
                placeholder="書籍名を入力" />
            <x-input-error :messages="$errors->get('title')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="author" :value="__('著者')" />
            <x-text-input id="author" class="block mt-1 w-full text-white" type="text" name="author"
                :value="old('author', $book->author ?? '')"
                placeholder="著者名を入力" />
            <x-input-error :messages="$errors->get('author')" class="mt-1" />
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <x-input-label for="rating" :value="__('評価')" />
                <select id="rating" name="rating"
                    class="block mt-1 w-full border-white/30 rounded-sm bg-black text-white">
                    <option value="">－</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $book->rating ?? '') == $i ? 'selected' : '' }}>
                            {{ str_repeat('★', $i) }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="flex-1">
                <x-input-label for="read_at" :value="__('読了日')" />
                <x-text-input id="read_at" class="block mt-1 w-full text-white" type="date" name="read_at"
                    :value="old('read_at', isset($book) && $book->read_at ? $book->read_at->format('Y-m-d') : '')" />
            </div>
        </div>

        <div>
            <x-input-label for="description" :value="__('あらすじ')" />
            <textarea id="description" name="description" rows="3"
                class="block mt-1 w-full border-white/30 bg-black text-white"
                placeholder="あらすじを入力">{{ old('description', $book->description ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="review" :value="__('感想')" />
            <textarea id="review" name="review" rows="3"
                class="block mt-1 w-full border-white/30 bg-black text-white"
                placeholder="感想を入力">{{ old('review', $book->review ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('review')" class="mt-1" />
        </div>
    </div>
</div>