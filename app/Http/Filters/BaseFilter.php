<?php

    namespace App\Http\Filters;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Http\Request;

    class BaseFilter
    {
        protected Builder $builder;
        protected Request $request;
        protected array $sortable = [];
        protected array $allowedIncludes = [];

        public function __construct(Request $request) {
            $this->request = $request;
        }

        public function apply(Builder $builder): Builder {
            $this->builder = $builder;

            foreach ($this->request->all() as $key => $value) {
                if (method_exists($this, $key)) {
                    $this->$key($value);
                }
            }

            // Handle includes if present in the query
            if ($this->request->has('include')) {
                $this->include($this->request->input('include'));
            }

            return $builder;
        }

        protected function filter($arr): Builder {
            foreach ($arr as $key => $value) {
                if (method_exists($this, $key)) {
                    $this->$key($value);
                }
            }

            return $this->builder;
        }

        protected function include($value): void {
            $relationships = explode(',', $value);

            foreach ($relationships as $relationship) {
                // Only include relationships that are in the $allowedIncludes array
                if (in_array($relationship, $this->allowedIncludes)) {
                    $this->builder->with($relationship);
                }
            }
        }

        protected function sort($value): void {
            $sortAttributes = explode(',', $value);

            foreach ($sortAttributes as $sortAttribute) {
                $direction = 'asc';

                if (str_starts_with($sortAttribute, '-')) {
                    $direction = 'desc';
                    $sortAttribute = substr($sortAttribute, 1);
                }

                if (! in_array($sortAttribute, $this->sortable) && ! array_key_exists($sortAttribute,
                        $this->sortable)) {
                    continue;
                }

                $columnName = $this->sortable[$sortAttribute] ?? null;

                if ($columnName === null) {
                    $columnName = $sortAttribute;
                }

                $this->builder->orderBy($columnName, $direction);
            }
        }
    }
