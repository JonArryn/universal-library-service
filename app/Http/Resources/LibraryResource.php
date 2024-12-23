<?php

    namespace App\Http\Resources;

    use App\Models\Library;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    /**
     * @mixin Library
     */
    class LibraryResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'type'       => 'library',
                'id'         => $this->id,
                'name'       => $this->name,
                'userId'     => $this->user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
        }
    }
