<?php

    namespace App\Http\Resources;

    use App\Http\Resources\BaseResourceCollection;

    class BookResourceCollection extends BaseResourceCollection
    {

        public function toArray($request): array {
            return [
                'data' => BookResource::collection(),
            ];
        }

    }
