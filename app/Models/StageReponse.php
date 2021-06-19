<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StageReponse extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'date_stage',
        'stage_id',
        'content'
    ];
}
