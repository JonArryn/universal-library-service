<?php

    namespace App\Http\Controllers\Api;

    use App\traits\ApiResponses;
    use Illuminate\Support\Facades\Gate;

    class ApiController
    {
        use ApiResponses;

        protected $policyClass;

        public function isAble($ability, $modelInstance) {
            return Gate::allows($ability, $modelInstance);
        }
    }
