<?php
// app/Models/Song.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function albums()
    {
<<<<<<< HEAD
        return $this->belongsToMany(Album::class);
=======
        return $this->belongsToMany (Album::class);
>>>>>>> 50c894a86b61dccd84cf6a8ee60896140aee874b
    }
     // Geef de tabelnaam op
     protected $table = 'songs';

     // Geef de primaire sleutel aan (standaard is 'id')
     protected $primaryKey = 'id';
 
     // Geef het type van de primaire sleutel aan (standaard is 'int')
     protected $keyType = 'string';
     protected $fillable = ['title', 'singer'];
 
     // Geef aan of de timestamps moeten worden bijgehouden (standaard is true)
     public $timestamps = true;
<<<<<<< HEAD
}
=======
 }
>>>>>>> 50c894a86b61dccd84cf6a8ee60896140aee874b

