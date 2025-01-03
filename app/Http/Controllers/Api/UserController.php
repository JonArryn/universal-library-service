<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\User\StoreUserRequest;
    use App\Http\Requests\Api\User\UpdateUserRequest;
    use App\Http\Resources\UserResource;
    use App\Models\Library;
    use App\Models\User;
    use App\Policies\UserPolicy;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class UserController extends ApiController
    {
        protected $policyClass = UserPolicy::class;

        /**
         * Display a listing of the resource.
         */
        public function index() {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreUserRequest $request) {
            if (! $this->isAble('create', User::class)) {
                return $this->notAuthorized('You are not authorized to create users.');
            }
            return DB::transaction(function () use ($request) {
                $user = User::create($request->mappedAttributes());
                Auth::login($user);
                $defaultLibrary = Library::create([
                    'name'    => $user->name . '\'s Library',
                    'user_id' => Auth::user()->id]);
                $defaultLibrary->books()->create(['title'       => 'My First Book',
                                                  'author_name' => 'My First Author',
                                                  'description' => 'My First Book Description']);
                return $this->ok('success',
                    ['user' => new UserResource($user)],
                    201);
            });

        }

        /**
         * Display the specified resource.
         */
        public function show(User $user) {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateUserRequest $request, User $user) {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(User $user) {
            //
        }
    }
