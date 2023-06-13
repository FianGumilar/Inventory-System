<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class SubmitBookResource extends JsonResource
{
    private $message;

    public function __construct($resource, $message)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource;
        $this->message = $message;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'id' => $this->id,
                'book_title' => $this->book_title,
                'book_number' => $this->book_number,
                'location' => $this->location,
                'is_scan' => $this->is_scan,
                'file_path' => $this->file_path,
                'category_name' => $this->category_name,
                'utility_name' => $this->utility_name,
            ],
            'meta' => [
                'success' => true,
                'message' => $this->message,
                'pagination' => (object) [],
            ],
        ];
    }
}