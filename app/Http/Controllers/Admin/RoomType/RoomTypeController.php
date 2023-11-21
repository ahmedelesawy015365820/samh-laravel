<?php

namespace App\Http\Controllers\Admin\RoomType;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\RoomTypeRequest;
use App\Repositery\RoomType\RoomTypeInterface;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    protected $roomType;

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(RoomTypeInterface $roomType){
        $this->roomType = $roomType;
    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function get(Request $request)
    {
        return $this->roomType->getAll($request);
    }

    public function create(RoomTypeRequest $request)
    {
        return $this->roomType->create($request->validated());
    }


    public function update(RoomTypeRequest $request, $id)
    {
        return $this->roomType->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->roomType->destroy($id);
    }
}
