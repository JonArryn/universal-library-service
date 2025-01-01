<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class ReportController extends ApiController
    {
        public function libraryBookCount() {
            $libraries = Auth::user()->library()->withCount('books')->get();
            return $this->ok('success', $libraries);
        }
    }
