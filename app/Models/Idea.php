<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory, Sluggable;

    public const IDEAS_PER_PAGE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCreatedAtAttribute($date)
    {
        Date::setLocale('pt');

        return Date::createFromFormat('Y-m-d H:i:s', $date);
    }

    public function getUpdatedAtAttribute($date)
    {
        Date::setLocale('pt');
        
        return Date::createFromFormat('Y-m-d H:i:s', $date);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
