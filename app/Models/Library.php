<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Auth;
    use Laravel\Sanctum\HasApiTokens;

    class Library extends Model
    {
        use HasFactory;

        protected $fillable = [
            'name',
            'user_id'
            // 'user_id' is intentionally excluded to prevent mass assignment
        ];

        protected static function booted(): void {
            static::creating(function ($library) {
                $library->user_id = Auth::id();
            });
        }

        public function user(): BelongsTo {
            return $this->belongsTo(User::class);
        }

        public function books(): HasMany {
            return $this->hasMany(Book::class);
        }
    }
