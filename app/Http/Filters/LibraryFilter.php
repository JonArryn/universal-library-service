<?php

    namespace App\Http\Filters;

    class LibraryFilter extends BaseFilter
    {
        public function status($value) {
            return $this->builder->where('status', $value);
        }
    }
