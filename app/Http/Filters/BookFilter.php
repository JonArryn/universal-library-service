<?php

    namespace App\Http\Filters;

    use App\Http\Filters\BaseFilter;

    class BookFilter extends BaseFilter
    {
        protected array $sortable = [
            'title'      => 'title',
            'authorName' => 'author_name',];
        protected array $allowedIncludes = ['library'];

        public function title($value): void {
            $this->builder->where('title', $value);
        }

        public function authorName($value): void {
            $this->builder->where('author_name', $value);
        }

        public function search($value): void {
            $this->builder->where(function ($query) use ($value) {
                $query->where('title', 'like', "%{$value}%")
                    ->orWhere('author_name', 'like', "%{$value}%");
            });
        }


    }
