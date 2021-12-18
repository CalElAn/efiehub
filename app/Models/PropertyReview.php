<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyReview extends Model
{
    use HasFactory;

    protected $table = 'property_review';

    protected $primaryKey = 'property_review_id';
}
