<?php

    namespace App\Http\Requests\Api\LibraryBook;

    use Illuminate\Foundation\Http\FormRequest;

    class BaseLibraryBookRequest extends FormRequest
    {
        public function mappedAttributes(array $otherAttributes = []): array {
            $attributeMap = array_merge([
                'title'       => 'title',
                'authorName'  => 'author_name',
                'description' => 'description',
                'libraryId'   => 'library_id',
                'createdAt'   => 'created_at',
                'updatedAt'   => 'updated_at',
            ], $otherAttributes);

            $attributesToUpdate = [];
            foreach ($attributeMap as $key => $attribute) {
                if ($this->has($key)) {
                    $attributesToUpdate[$attribute] = $this->input($key);
                }
            }

            return $attributesToUpdate;
        }
    }
