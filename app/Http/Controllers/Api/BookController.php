<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\RefreshDatabase;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function index() : JsonResponse {
        $books = Book::search(request()->get('search'))->paginate(20);
        
        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    public function import(): JsonResponse {

        $response = Http::get('https://fakerapi.it/api/v1/books?_quantity=200');

        if($response->successful()) {
            $data = $response->json()['data'];
            $chunks = collect($data)->chunk(5);
            foreach ($chunks as $key => $chunk) {
                RefreshDatabase::dispatch($chunk->toArray());
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => '',
            'message' => 'Importing books is in progress, Update you once it is done.'
        ]);
    }
}
