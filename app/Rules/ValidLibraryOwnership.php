<?php

    namespace App\Rules;

    use App\Models\Library;
    use Closure;
    use Illuminate\Contracts\Validation\ValidationRule;

    class ValidLibraryOwnership implements ValidationRule
    {
        /**
         * Run the validation rule.
         *
         * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
         */
        public function validate(string $attribute, mixed $value, Closure $fail): void {
            $exists = Library::where('id', $value)
                ->where('user_id', Auth::id())
                ->exists();

            if (! $exists) {
                $fail('The library id provided must be owned by the current user.');
            }
        }
    }
