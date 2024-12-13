<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Requests\Api\Library\StoreLibraryRequest;
    use App\Http\Requests\Api\Library\UpdateLibraryRequest;
    use App\Http\Resources\LibraryResource;
    use App\Models\Library;
    use App\Policies\LibraryPolicy;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;


    class LibraryController extends ApiController
    {
        protected $policyClass = LibraryPolicy::class;

        /**
         * Display a listing of the resource.
         */
        public function index(Request $request) {
            if (! $this->isAble('create', Library::class)) {
                return $this->notAuthorized('You are not authorized to view libraries');
            }
            $userLibraries = LibraryResource::collection(Auth::user()->library()->paginate());
            return $this->ok('success', $userLibraries->toArray($request));
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
