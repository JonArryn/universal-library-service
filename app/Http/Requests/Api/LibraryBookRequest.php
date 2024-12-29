<?php

    namespace App\Http\Requests\Api;

    use App\Models\Library;
    use App\Models\User;
    use Illuminate\Foundation\Http\FormRequest;

    class LibraryBookRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(User $user, Library $library): bool {
            return $library->user_id === $user->id;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array {
            return [];
        }
    }
