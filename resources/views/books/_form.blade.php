<div class="flex flex-col md:flex-row md:items-start md:justify-center md:gap-8 mt-10">
    <div class="flex-shrink-0 w-40">
        <div class="w-full aspect-[2/3] border border-white/30 rounded flex flex-col items-center justify-center text-white text-xs text-center overflow-hidden">
            <img id="book-thumbnail" src="{{ old('thumbnail', $book->thumbnail ?? '') }}" alt="表紙" class="{{ old('thumbnail', $book->thumbnail ?? '') ? '' : 'hidden' }} w-full h-full object-cover rounded" />
            <div id="thumbnail-placeholder" class="{{ old('thumbnail', $book->thumbnail ?? '') ? 'hidden' : '' }}">
                <span>
                    表紙画像<br>
                    （書籍検索時に自動取得）
                </span>
            </div>
        </div>
    </div>

    {{-- 右カラム: フォーム --}}
    <div class="flex-1 space-y-4 mt-5 md:mt-0">
        {{-- タイトル（検索UI付き） --}}
        <div class="relative">
            <x-input-label for="title" :value="__('タイトル')" />
            <x-text-input id="title" class="block mt-1 w-full text-white" type="text" name="title" :value="old('title', $book->title ?? '')" placeholder="書籍名を入力して検索" autocomplete="off"/>
            <x-input-error :messages="$errors->get('title')" class="mt-1" />
            {{-- 候補ドロップダウン --}}
            <ul id="book-suggestions" class="hidden absolute z-50 w-full mt-1 bg-[#1a1a1a] border border-white/20 rounded shadow-lg max-h-72 overflow-y-auto">
            </ul>
            <input type="hidden" id="thumbnail-input" name="thumbnail" value="{{ old('thumbnail', $book->thumbnail ?? '') }}" />
        </div>

        <div>
            <x-input-label for="author" :value="__('著者')" />
            <x-text-input id="author" class="block mt-1 w-full text-white" type="text" name="author" :value="old('author', $book->author ?? '')" placeholder="著者名を入力" />
            <x-input-error :messages="$errors->get('author')" class="mt-1" />
        </div>

        <div class="flex gap-4">
            <div class="flex-1">
                <x-input-label for="rating" :value="__('評価')" />
                <select id="rating" name="rating" class="block mt-1 w-full border-white/30 rounded-sm bg-black text-white">
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
                <x-text-input id="read_at" class="block mt-1 w-full text-white" type="date" name="read_at" :value="old('read_at', isset($book) && $book->read_at ? $book->read_at->format('Y-m-d') : '')" />
            </div>
        </div>

        <div>
            <x-input-label for="description" :value="__('あらすじ')" />
            <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-white/30 bg-black text-white" placeholder="あらすじを入力">{{ old('description', $book->description ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="review" :value="__('感想')" />
            <textarea id="review" name="review" rows="3" class="block mt-1 w-full border-white/30 bg-black text-white" placeholder="感想を入力">{{ old('review', $book->review ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('review')" class="mt-1" />
        </div>
    </div>
</div>

<script>
    (function () {
        // Google Books API を使った書籍検索・自動入力スクリプト
        // タイトル入力時に候補を表示し、選択するとフォームに自動入力する
        const titleInput   = document.getElementById('title');
        const authorInput  = document.getElementById('author');
        const descInput    = document.getElementById('description');
        const suggestions  = document.getElementById('book-suggestions');
        const thumbnail    = document.getElementById('book-thumbnail');
        const placeholder  = document.getElementById('thumbnail-placeholder');

        let debounceTimer = null;

        // 入力のたびに検索
        titleInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const q = this.value.trim();

            if (q.length < 1) {
                hideSuggestions();
                return;
            }

            debounceTimer = setTimeout(() => fetchSuggestions(q), 400);
        });

        // バックエンド経由で Google Books API にリクエスト
        async function fetchSuggestions(q) {
            try {
                const res = await fetch(`{{ route('books.search') }}?q=${encodeURIComponent(q)}`);
                const data = await res.json();
                renderSuggestions(data);
            } catch (e) {
                hideSuggestions();
            }
        }

        // 検索結果をドロップダウンとしてレンダリング
        function renderSuggestions(books) {
            suggestions.innerHTML = '';

            if (!books.length) {
                hideSuggestions();
                return;
            }

            books.forEach(book => {
                const li = document.createElement('li');
                li.className = 'flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-white/10 transition-colors border-b border-white/10 last:border-0';

                const img = book.thumbnail
                    ? `<img src="${book.thumbnail}" class="w-8 h-12 object-cover rounded flex-shrink-0" />`
                    : `<div class="w-8 h-12 bg-white/10 rounded flex-shrink-0"></div>`;

                li.innerHTML = `
                    ${img}
                    <div class="min-w-0">
                        <p class="text-white text-sm font-medium truncate">${book.title}</p>
                        <p class="text-white/50 text-xs truncate">${book.author}</p>
                    </div>
                `;

                li.addEventListener('click', () => selectBook(book));
                suggestions.appendChild(li);
            });

            suggestions.classList.remove('hidden');
        }

        // 候補選択時にフォームへ自動入力・表紙画像をプレビュー表示
        function selectBook(book) {
            titleInput.value  = book.title;
            authorInput.value = book.author;
            descInput.value   = book.description;
            document.getElementById('thumbnail-input').value = book.thumbnail ?? '';

            if (book.thumbnail) {
                thumbnail.src = book.thumbnail;
                thumbnail.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }

            hideSuggestions();
        }

        function hideSuggestions() {
            suggestions.classList.add('hidden');
            suggestions.innerHTML = '';
        }

        // 外側クリックで候補を閉じる
        document.addEventListener('click', function (e) {
            if (!titleInput.contains(e.target) && !suggestions.contains(e.target)) {
                hideSuggestions();
            }
        });
    })();
</script>