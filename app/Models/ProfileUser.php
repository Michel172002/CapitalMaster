<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    protected $fillable = [
        'user_id',
        'income',
        'currency',
        'objective',
    ];

    protected $table = 'profile_users';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
