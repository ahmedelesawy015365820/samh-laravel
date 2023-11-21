<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //  start relation

    public function status(){
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function roomType(){
        return $this->belongsTo(RoomType::class,'room_type_id','id');
    }

    //  end relation
}
