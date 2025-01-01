<?php

    namespace App\Http\Requests\Api\Book;

    use App\Http\Requests\Api\ValidatesRequest;
    use Illuminate\Foundation\Http\FormRequest;

    class UpdateBookRequest extends BaseBookRequest implements ValidatesRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array {
            return [
                'title'       => 'required|string|max:99',
                'authorName'  => 'required|string|max:99',
                'description' => 'string|max:254',
                'libraryId'   => ['required', 'integer', 'max:254', 'exists:libraries,id']
            ];
        }
    }
