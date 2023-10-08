<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Service extends Model
{
    use HasFactory, SearchableTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'services.title' => 10,
            'services.details' => 10,
        ],
    ];

    protected $fillable = [
        'title',
        'adress',
        'provider_id',
        'details',
        'price',
        'photo',
    ];
    public function Files()
    {
        return $this->morphMany(File::class, 'Filable');
    }
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'category_service', 'service_id', 'category_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
