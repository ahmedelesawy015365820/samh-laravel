<?php

namespace App\Repositery\Status;

interface StatusInterface {

    public function getAll($request);

    public function create($request);

    public function update($request, $id);

    public function destroy($id);

}
