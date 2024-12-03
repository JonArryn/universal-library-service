<?php

    namespace App\Http\Requests\Api\User;

    use Illuminate\Foundation\Http\FormRequest;

    class BaseUserRequest extends FormRequest
    {
        public function mappedAttributes(array $otherAttributes = []): array {
            $attributeMap = array_merge([
                'name'     => 'name',
                'email'    => 'email',
                'password' => 'password'
            ], $otherAttributes);

            $attributesToUpdate = [];
            foreach ($attributeMap as $key => $attribute) {
                if ($this->has($key)) {
                    $value = $this->input($key);

                    if ($attribute === 'password') {
                        $value = bcrypt($value);
                    }

                    $attributesToUpdate[$attribute] = $value;
                }
            }
            return $attributesToUpdate;
        }
    }
