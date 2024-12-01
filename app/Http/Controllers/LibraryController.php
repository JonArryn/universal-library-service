<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\Library\StoreLibraryRequest;
    use App\Http\Requests\Library\UpdateLibraryRequest;
    use App\Models\Library;

    class LibraryController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index() {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreLibraryRequest $request) {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show(Library $library) {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateLibraryRequest $request, Library $library) {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Library $library) {
            //
        }
    }
