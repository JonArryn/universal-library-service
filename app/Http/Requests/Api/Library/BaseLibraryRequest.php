<?php

    namespace App\Http\Requests\Api\Library;

    use Illuminate\Foundation\Http\FormRequest;

    class BaseLibraryRequest extends FormRequest
    {
        public function mappedAttributes(array $otherAttributes = []): array {
            $attributeMap = array_merge([
                'name'      => 'name',
                'userId'    => 'user_id',
                'createdAt' => 'created_at',
                'updatedAt' => 'updated_at',
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
