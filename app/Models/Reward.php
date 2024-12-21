<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = ['reward_level', 'reward_name', 'image'];
    
    public function rewardImages() {
        return $this->hasMany(RewardImage::class);
    }
}
