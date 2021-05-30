<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = [
        "nom",
        "prenom",
        "profession",
        "mail",
        "telephone",
        "sujet",
        "message",
        "attachment",
        "destinataire",
        "accepter"
    ];
}
