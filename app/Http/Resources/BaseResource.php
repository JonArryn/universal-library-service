<?php

    namespace App\Http\Resources;
    
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class BaseResource extends JsonResource
    {
        protected array $defaultAttributes = [];
        protected Request $request;

        /**
         * Transform the resource into an array.
         */
        public function toArray(Request $request): array {
            $this->request = $request;

            // Get fields and includes from the request
            $fields = $request->query('fields') ? explode(',', $request->query('fields')) : [];
            $includes = $request->query('include') ? explode(',', $request->query('include')) : [];

            // Filter attributes based on fields
            $attributes = $fields
                ? array_intersect_key($this->defaultAttributes(), array_flip($fields))
                : $this->defaultAttributes();

            // Add relationships dynamically if they are loaded and requested in includes
            foreach ($includes as $include) {
                if ($this->resource->relationLoaded($include)) {
                    $attributes[$include] = $this->resolveRelationship($include);
                }
            }

            return $attributes;
        }

        /**
         * Define the default attributes of the resource.
         */
        protected function defaultAttributes(): array {
            return $this->defaultAttributes;
        }

        protected function resolveRelationship(string $relation) {
            return $this->{$relation}; // Default behavior, override as needed
        }
    }
