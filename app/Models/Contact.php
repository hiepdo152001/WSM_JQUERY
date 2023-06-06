<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'contacts';
    protected $fillable = [
        'user_id',
        'content',
        'type',
        'phone',
        'project',
        'reason',
        'time_start',
        'time_end',
        'status',
        'deadline',
        'flag',
        'month',
        'assets_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
