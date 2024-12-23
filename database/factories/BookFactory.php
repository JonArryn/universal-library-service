<?php

    namespace Database\Factories;

    use App\Models\Book;
    use App\Models\Library;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
     */
    class BookFactory extends Factory
    {
        protected $model = Book::class;

        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array {
            return [
                'library_id'  => Library::factory(),
                'title'       => fake()->words(3, true),
                'author_name' => fake()->name(),
                'description' => fake()->sentence(10)
            ];
        }
    }
