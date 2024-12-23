<?php

    namespace App\Models;

    use App\Http\Filters\BaseFilter;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Builder;


    class Book extends Model
    {
        use HasFactory;

        protected $table = 'books';

        protected $fillable = [
            'library_id',
            'title',
            'author_name',
            'description',
        ];

        public function library(): BelongsTo {
            return $this->belongsTo(Library::class);
        }

        public function scopeFilter(Builder $builder, BaseFilter $filters) {
            return $filters->apply($builder);
        }
    }
