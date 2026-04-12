<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->latest()->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'review'      => 'nullable|string',
            'rating'      => 'nullable|integer|min:1|max:5',
            'read_at'     => 'nullable|date',
        ]);

        $validated['user_id'] = Auth::id();

        Book::create($validated);

        return redirect()->route('books.index')->with('success', '書籍を登録しました');
    }

    public function show(Book $book)
    {
        abort_if($book->user_id !== Auth::id(), 403);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        abort_if($book->user_id !== Auth::id(), 403);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        abort_if($book->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'review'      => 'nullable|string',
            'rating'      => 'nullable|integer|min:1|max:5',
            'read_at'     => 'nullable|date',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', '書籍を更新しました');
    }

    public function destroy(Book $book)
    {
        abort_if($book->user_id !== Auth::id(), 403);
        $book->delete();
        return redirect()->route('books.index')->with('success', '書籍を削除しました');
    }
}