<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'album_song')
            ->withPivot('title', 'singer')
            ->withTimestamps();
    }

    public function band()
<<<<<<< HEAD
    {
        return $this->belongsTo(Band::class);
    }
=======
{
    return $this->belongsTo(Band::class);
}
>>>>>>> 50c894a86b61dccd84cf6a8ee60896140aee874b


    protected $fillable = [
        'name', 'year', 'times_sold', 'band_id'
    ];
}
