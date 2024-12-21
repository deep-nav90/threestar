<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reward;

class ClaimReward extends Model
{
    use HasFactory;

    public function reward(){
        return $this->belongsTo(Reward::class);
    }
}
