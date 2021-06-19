<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitReponse extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'date_visit',
        'visit_id',
        'content'
    ];
}
