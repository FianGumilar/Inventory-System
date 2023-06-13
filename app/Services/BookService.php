<?php

namespace App\Services;

use App\Models\Book;
use App\Services\FileService;

class BookService
{
    public function getData($request)
    {
        $search = $request->search;
        $filter_category = $request->filter_category;
        $filter_utility = $request->filter_utility;

        $query = Book::query();

        // Filtering data
        $query->when(request('search', false), function ($q) use ($search) {
            $q->where('book_title', 'like', '%' . $search . '%');
        });
        $query->when(request('filter_category', false), function ($q) use ($filter_category) {
            $q->where('category_id', $filter_category);
        });
        $query->when(request('filter_utility', false), function ($q) use ($filter_utility) {
            $q->where('utility_id', $filter_utility);
        });

        return $query->paginate(20);
    }

    public function createData($request)
    {
        // Create the product after that
        $inputs = $request->only(['book_title', 'book_number', 'location', 'is_scan', 'file_path', 'category_id', 'utility_id']);
        $book = Book::create($inputs);

        return $book;
    }

    public function deleteData($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return $book;
    }

    public function updateData($id, $request)
    {
        // Get Product Data
        $book = Book::findOrFail($id);

        // Update the product data
        $inputs = $request->only(['book_title', 'book_number', 'location', 'is_scan', 'file_path', 'category_id', 'utility_id']);
        $book->update($inputs);

        return $book;
    }
}