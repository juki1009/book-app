<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('user_id', Auth::id())->latest()->paginate(9);
        return view('books.index', compact('books'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        if (!$query) {
            return response()->json([]);
        }

        $apiKey = config('services.google_books.api_key');
        $url = "https://www.googleapis.com/books/v1/volumes?q=" . urlencode($query) . "&langRestrict=ja&maxResults=5&key=" . $apiKey;

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json([]);
        }

        $books = collect($response->json('items', []))->map(function ($item) {
            $info = $item['volumeInfo'];
            return [
                'title'       => $info['title'] ?? '',
                'author'      => isset($info['authors']) ? implode(', ', $info['authors']) : '',
                'description' => $info['description'] ?? '',
                'thumbnail'   => $info['imageLinks']['thumbnail'] ?? '',
            ];
        });

        return response()->json($books);
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