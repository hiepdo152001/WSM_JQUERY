<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_keep extends Model
{
    use HasFactory;
    protected $table = 'timeKeep';
    protected $fillable = [
        'user_id',
        'time_in',
        'time_out',
        'day',
        'month',
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
