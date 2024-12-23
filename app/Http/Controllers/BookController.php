<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Api\ApiController;
    use App\Http\Filters\BookFilter;
    use App\Http\Requests\Api\Book\StoreBookRequest;
    use App\Http\Requests\Api\Book\UpdateBookRequest;
    use App\Http\Resources\BaseResourceCollection;
    use App\Http\Resources\BookResource;
    use App\Http\Resources\BookResourceCollection;
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
        public function index(BookFilter $filters) {
            if (! $this->isAble('viewAny', Book::class)) {
                return $this->notAuthorized('You are not authorized to view books that do not belong to libraries you do not own');
            }

            return BookResource::collection(Book::filter($filters)->paginate());

//            $userBooks = Auth::user()->book()->paginate();
//            return BookResource::collection($userBooks);

        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreBookRequest $request) {
            if (! $this->isAble('store', Book::class)) {
                return $this->notAuthorized('You are not authorized to create books');
            }

            $newBook = new BookResource(Book::create($request->mappedAttributes()));

            return $this->ok('success', [$newBook], 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Book $book) {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateBookRequest $request, Book $book) {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Book $book) {
            //
        }
    }
