<?php

    namespace App\Providers;

    use App\Http\Requests\Api\Book\StoreBookRequest;
    use App\Http\Requests\Api\Book\UpdateBookRequest;
    use App\Http\Requests\Api\ValidatesRequest;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         */
        public function register(): void {
            $this->app->bind(ValidatesRequest::class, function ($app) {
                // Here, you can dynamically decide which implementation to return
                // Example: Based on the request's route
                $routeName = $app['router']->currentRouteName();

                return match ($routeName) {
                    'books.store' => $app->make(StoreBookRequest::class),
                    'books.update' => $app->make(UpdateBookRequest::class),
                    default => throw new \Exception('No valid request class found for route: ' . $routeName),
                };
            });
        }

        /**
         * Bootstrap any application services.
         */
        public function boot(): void {
            DB::listen(function ($query) {
                logger($query->sql, $query->bindings);
            });
        }
    }
