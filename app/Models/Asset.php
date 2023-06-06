<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $table = 'assets';
    protected $fillable = [
        'name',
        'code',
        'location',
        'user_id',
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}