<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class BaseResource extends JsonResource
    {
        protected array $defaultAttributes = [];

        /**
         * Transform the resource into an array.
         */
        public function toArray(Request $request): array {
            // Retrieve the `fields` parameter from the request
            $fields = $request->query('fields') ? explode(',', $request->query('fields')) : null;

            // Collect all attributes of the resource
            $attributes = $this->defaultAttributes();

            // Return only requested fields, or all attributes if no fields are specified
            return $fields ? array_intersect_key($attributes, array_flip($fields)) : $attributes;
        }

        /**
         * Define the default attributes of the resource.
         */
        protected function defaultAttributes(): array {
            return $this->defaultAttributes;
        }
    }
