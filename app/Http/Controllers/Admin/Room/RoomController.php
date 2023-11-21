<?php

namespace App\Http\Controllers\Admin\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomRequest;
use App\Repositery\Room\RoomInterface;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected $room;

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(RoomInterface $room){
        $this->room = $room;
    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function get(Request $request)
    {
        return $this->room->getAll($request);
    }

    public function create(RoomRequest $request)
    {
        return $this->room->create($request->validated());
    }

    public function update(RoomRequest $request, $id)
    {
        return $this->room->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->room->destroy($id);
    }

    public function getDropdown(){
        return $this->room->getDropdown();
    }
}
