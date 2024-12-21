<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardImage extends Model
{
    use HasFactory;

    public function getImageAttribute($value){
        if(!empty($value)){

            $path_file = public_path(). '/storage/uploadFiles' . '/' . $value;

            if(file_exists($path_file)){
                return url('/public/storage/uploadFiles') . '/' . $value;
            }else{

                return url('/public/admin/assets/img') . "/" . 'dummy-t.png';
            } 
        }else{
            return $value;
        }
    }

}
