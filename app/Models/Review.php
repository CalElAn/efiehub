<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'updated_at' => 'datetime:M Y',
        'rating' => 'float',
    ];

    protected $with = ['user'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->latest();
        });
    }

    /**
     * Get the parent reviewable model (user or property).
     */
    public function reviewable()
    {
        return $this->morphTo();
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
