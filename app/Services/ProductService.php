<?php

namespace App\Services;

use App\Models\Product;
use App\Services\FileService;

class ProductService
{
    public function getData($request)
    {
        $search = $request->search;
        $filter_category = $request->filter_category;
        $filter_utility = $request->filter_utility;

        $query = Product::query();

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
        $inputs = $request->only(['book_title', 'book_number', 'location', 'is_input', 'file_path', 'category_id', 'utility_id']);
        $product = Product::create($inputs);

        return $product;
    }

    public function deleteData($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return $product;
    }

    public function updateData($id, $request)
    {
        // Get Product Data
        $product = Product::findOrFail($id);

        // Update the product data
        $inputs = $request->only(['book_title', 'book_number', 'location', 'is_input', 'file_path', 'category_id', 'utility_id']);
        $product->update($inputs);

        return $product;
    }
}