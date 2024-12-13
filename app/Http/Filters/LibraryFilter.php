<?php

    namespace App\Http\Filters;

    class LibraryFilter
    {
        public function status($value) {
            return $this->builder->where('stats', $value);
        }
    }
