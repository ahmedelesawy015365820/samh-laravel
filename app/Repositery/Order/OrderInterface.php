<?php

namespace App\Repositery\Order;

interface OrderInterface {

    public function getAll($request);

    public function create($request);

    public function update($request, $id);

    public function destroy($id);

}
