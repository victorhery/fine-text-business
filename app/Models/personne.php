<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personne extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom','email', 'compte','choisis_portef', 'adress_portef', 'lieu', 'image'];
}
