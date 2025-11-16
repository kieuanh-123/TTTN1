<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\KarateClass> $classes
 * @property-read int|null $classes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Instructor query()
 * @mixin \Eloquent
 */
class Instructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'image',
        'email',
        'facebook',
        'instagram',
        'linkedin',
        'featured',
    ];

    public function classes()
    {
        return $this->hasMany(KarateClass::class);
    }

    // New relationships
    public function sessions()
    {
        return $this->hasMany(ClassSession::class);
    }
}