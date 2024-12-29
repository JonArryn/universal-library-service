<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\User\StoreUserRequest;
    use App\Http\Requests\Api\User\UpdateUserRequest;
    use App\Http\Resources\UserResource;
    use App\Models\User;
    use App\Policies\UserPolicy;
    use Illuminate\Support\Facades\Auth;

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
            $user = User::create($request->mappedAttributes());
            Auth::login($user);
            return $this->ok('success',
                ['user' => new UserResource($user)],
                201);
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
