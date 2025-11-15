<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \App\Models\Instructor|null $instructor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KarateClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KarateClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KarateClass query()
 * @mixin \Eloquent
 */
class KarateClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'description',
        'image',
        'schedule',
        'instructor_id',
        'level',
        'price',
        'featured',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}