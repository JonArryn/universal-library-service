<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Filters\BookFilter;
    use App\Http\Resources\BookResource;
    use App\Models\Library;
    use Illuminate\Http\Request;

    class LibraryBookController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(BookFilter $filters, $libraryId) {
            $library = Library::findOrFail($libraryId);

            $books = $library->book()->filter($filters)->paginate(15);

            return BookResource::collection($books);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request) {
            //
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
