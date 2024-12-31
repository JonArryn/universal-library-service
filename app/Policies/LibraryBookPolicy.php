<?php

    namespace App\Policies;

    use App\Models\Library;
    use App\Models\User;

    class LibraryBookPolicy
    {
        /**
         * Create a new policy instance.
         */
        public function viewAny(Library $library, User $user) {
            $library->user_id === $user->id;
        }

        public function create(Library $library, User $user) {
            return $library->user_id === $user->id;
        }
    }
