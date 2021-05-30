<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $fillable = [
        
        "nom",
        "prenom",
        "mail",
        "telephone",
        "institut",
        "type_stage",
        "cv",
        "lettre_motivation",
        "date_debut",
        "date_fin",
        "accepted"
  
    ];
}
