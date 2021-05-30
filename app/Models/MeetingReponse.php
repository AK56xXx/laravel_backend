<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingReponse extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'date_meeting',
        'meeting_id',
        'content'
    ];
}
