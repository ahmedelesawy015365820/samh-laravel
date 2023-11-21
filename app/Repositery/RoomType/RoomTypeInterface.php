<?php

namespace App\Repositery\RoomType;

interface RoomTypeInterface {

    public function getAll($request);

    public function create($request);

    public function update($request, $id);

    public function destroy($id);

}
