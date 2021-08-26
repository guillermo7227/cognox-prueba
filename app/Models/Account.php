<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function scopeOwn($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeExternal($query)
    {
        return $query->where('user_id', '<>', auth()->id());
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
