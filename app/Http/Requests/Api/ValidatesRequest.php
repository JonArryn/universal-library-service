<?php

    namespace App\Http\Requests\Api;

    interface ValidatesRequest
    {
        public function authorize(): bool;

        public function rules(): array;
    }
