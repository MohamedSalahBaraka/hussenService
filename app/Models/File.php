<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'Filable_id',
        'Filable_type',
        'name',
        'path',
    ];
    public function Filable()
    {
        return $this->morphTo();
    }
}
