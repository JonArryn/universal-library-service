<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Filters\BookFilter;
    use App\Http\Requests\Api\Book\StoreBookRequest;
    use App\Http\Requests\Api\LibraryBook\StoreLibraryBookRequest;
    use App\Http\Resources\BookResource;
    use App\Models\Book;
    use App\Models\Library;
    use Illuminate\Http\Request;

    class LibraryBookController extends ApiController
    {
        /**
         * Display a listing of the resource.
         */
        public function index(BookFilter $filters, $library) {
            if (! $this->isAble('viewAny', Book::class)) {
                return $this->notAuthorized('You are not authorized to view books that do not belong to libraries you do not own');
            }
            $library = Library::findOrFail($library);

            $books = $library->book()->filter($filters)->paginate(15);

            return BookResource::collection($books);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Library $library, StoreLibraryBookRequest $request) {
            $newBook = new Book($request->mappedAttributes());
            $newBook->library_id = $library->id;
            if (! $request->user()->can('create', $newBook)) {
                return $this->notAuthorized('You are not authorized to create books in this library.');
            }
            $libraryBook = $library->book()->create($request->mappedAttributes());
            return $this->ok('success',
                ['book' => new BookResource($libraryBook)],
                201
            );
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id) {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id) {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id) {
            //
        }
    }
