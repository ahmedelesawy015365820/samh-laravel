<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //  start relation user

    public function room(){
        return $this->belongsTo(Room::class,'room_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    //  end relation
}
