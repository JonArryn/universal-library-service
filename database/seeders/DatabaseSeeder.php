<?php

    namespace Database\Seeders;

    use App\Models\Book;
    use App\Models\Library;
    use App\Models\User;
    use Illuminate\Database\Seeder;


    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void {
            $user = User::factory()->create([
                'name'  => 'Jon Arryn',
                'email' => 'development@arryn.net',
            ]);

            $library = Library::factory()->create([
                'name'    => 'Arryn Library',
                'user_id' => $user->id
            ]);

            $books = Book::factory(100)->create([
                'library_id' => $library->id,
            ]);

        }
    }

