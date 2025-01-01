<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Filters\BookFilter;
    use App\Http\Requests\Api\Book\StoreBookRequest;
    use App\Http\Requests\Api\Book\UpdateBookRequest;
    use App\Http\Requests\Api\ValidatesRequest;
    use App\Http\Resources\BookResource;
    use App\Models\Book;
    use App\Policies\BookPolicy;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class BookController extends ApiController
    {
        protected $policyClass = BookPolicy::class;

        /**
         * Display a listing of the resource.
         */
        public function index(BookFilter $filters, Request $request) {
            if ($request->user()->cannot('viewAny', Book::class)) {
                return $this->notAuthorized('You are not authorized to view books that do not belong to libraries you do not own');
            }

            $books = Auth::user()->book()->filter($filters)->paginate(15);
            return BookResource::collection($books);
        }


        /**
         * Store a newly created resource in storage.
         */
        public function store(ValidatesRequest $request) {
            if (Auth::user()->cannot('store', Book::class)) {
                return $this->notAuthorized('You are not authorized to create books');
            }

            $newBook = new BookResource(Book::create($request->mappedAttributes()));

            return $this->ok('success', [$newBook], 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Book $book, BookFilter $filters) {
            if (Auth::user()->cannot('view', $book)) {
                return $this->notAuthorized('You are not authorized to view this book');
            }
            $filteredBook = Book::filter($filters)->find($book->id);
            return $this->ok('success',
                new BookResource($filteredBook)
            );
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(ValidatesRequest $request, Book $book) {
            if (Auth::user()->cannot('update', $book)) {
                return $this->notAuthorized('You are not authorized to update this book');
            }
            $book->update($request->mappedAttributes());
            return $this->ok('success',
                ['book' => new BookResource($book)]
            );
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Book $book) {
            if (Auth::user()->cannot('delete', $book)) {
                return $this->notAuthorized('You are not authorized to delete this book');
            }
            $book->delete();
            return $this->ok('success', [], 204);
        }
    }
