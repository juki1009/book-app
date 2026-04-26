<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">タイトル <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">著者</label>
        <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('author')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">評価</label>
        <select name="rating" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">－</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ old('rating', $book->rating ?? '') == $i ? 'selected' : '' }}>
                    {{ str_repeat('★', $i) }}
                </option>
            @endfor
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">読了日</label>
        <input type="date" name="read_at" value="{{ old('read_at', $book->read_at ?? '') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">あらすじ</label>
        <textarea name="description" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('description', $book->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">感想</label>
        <textarea name="review" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('review', $book->review ?? '') }}</textarea>
    </div>
</div>