<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Actions\Options\GetUtilityOptions;
use App\Actions\Options\GetCategoryOptions;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookListResource;
use App\Http\Resources\Book\SubmitBookResource;

class BookController extends Controller
{
    public function __construct(BookService $bookService, GetCategoryOptions $getCategoryOptions, GetUtilityOptions $getUtilityOptions)
    {
        $this->bookService = $bookService;
        $this->getCategoryOptions = $getCategoryOptions;
        $this->getUtilityOptions = $getUtilityOptions;
    }

    public function index()
    {
        return Inertia::render('admin/product/index', [
            "title" => 'Book',
            "additional" => [
                'category_list' => $this->getCategoryOptions->handle(),
                'utility_list' => $this->getUtilityOptions->handle()
            ]
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->bookService->getData($request);

            $result = new BookListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createData(CreateBookRequest $request)
    {
        try {
            $data = $this->bookService->createData($request);

            $result = new SubmitBookResource($data, 'Success Create Book');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateBookRequest $request)
    {
        try {
            $data = $this->bookService->updateData($id, $request);

            $result = new SubmitBookResource($data, 'Success Update Book');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->bookService->deleteData($id);

            $result = new SubmitBookResource($data, 'Success Delete Book');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}