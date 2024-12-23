<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\ResourceCollection;

    class BaseResourceCollection extends ResourceCollection
    {
        public function toArray($request): array {
            $pagination = $this->resource;
            return [
                'data'       => $this->resource->collection,
                'pagination' => [
                    'current_page' => $pagination->currentPage(),
                    'last_page'    => $pagination->lastPage(),
                    'per_page'     => $pagination->perPage(),
                    'total'        => $pagination->total(),
                ]
            ];
        }
    }
