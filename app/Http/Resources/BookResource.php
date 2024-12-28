<?php

    namespace App\Http\Resources;

    use App\Models\Book;

    /**
     * @mixin Book
     */
    class BookResource extends BaseResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        protected function defaultAttributes(): array {

            return [
                'id'          => $this->id,
                'libraryId'   => $this->library_id,
                'title'       => $this->title,
                'authorName'  => $this->author_name,
                'description' => $this->description,
                'createdAt'   => $this->created_at,
                'updatedAt'   => $this->updated_at,
            ];

        }

        protected function resolveRelationship(string $relation) {
            return match ($relation) {
                'library' => new LibraryResource($this->library),
                default => parent::resolveRelationship($relation),
            };
        }
    }


