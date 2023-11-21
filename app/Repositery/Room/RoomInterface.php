<?php

namespace App\Repositery\Room;

interface RoomInterface {

    public function getAll($request);

    public function create($request);

    public function update($request, $id);

    public function destroy($id);

    public function getDropdown();

}
