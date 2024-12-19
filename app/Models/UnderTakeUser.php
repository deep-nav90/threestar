<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnderTakeUser extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sponserUser() {
        return $this->belongsTo(User::class, 'sponser_id', 'id');
    }

    public function uplineUser() {
        return $this->belongsTo(User::class, 'upline_id', 'id');
    }
}
