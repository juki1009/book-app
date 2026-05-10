<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->latest()->paginate(9);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        $validated = $request->validated();
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

    public function update(BookRequest $request, Book $book)
    {
        abort_if($book->user_id !== Auth::id(), 403);

        $book->update($request->validated());

        return redirect()->route('books.index')->with('success', '書籍を更新しました');
    }

    public function destroy(Book $book)
    {
        abort_if($book->user_id !== Auth::id(), 403);
        $book->delete();
        return redirect()->route('books.index')->with('success', '書籍を削除しました');
    }
}