<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = ['title', 'singer'];
    public $timestamps = true;

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }
}
