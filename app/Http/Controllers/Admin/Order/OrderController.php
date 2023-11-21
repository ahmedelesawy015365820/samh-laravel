<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Repositery\Order\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(OrderInterface $order){
        $this->order = $order;
    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function get(Request $request)
    {
        return $this->order->getAll($request);
    }

    public function create(OrderRequest $request)
    {
        return $this->order->create($request->validated());
    }

    public function update(OrderRequest $request, $id)
    {
        return $this->order->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->order->destroy($id);
    }
}
