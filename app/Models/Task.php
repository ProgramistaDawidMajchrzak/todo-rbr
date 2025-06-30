<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'priority',
        'status',
        'due_date',
        'user_id',
        'public_token',
        'public_token_expires_at',
    ];

    protected $casts = [
        'public_token_expires_at' => 'datetime',
        'due_date' => 'datetime'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
