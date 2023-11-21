<?php

namespace App\Http\Controllers\Admin\Status;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\StatusRequest;
use App\Repositery\Status\StatusInterface;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $status;

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(statusInterface $status){
        $this->status = $status;
    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function get(Request $request)
    {
        return $this->status->getAll($request);
    }

    public function create(StatusRequest $request)
    {
        return $this->status->create($request->validated());
    }


    public function update(StatusRequest $request, $id)
    {
        return $this->status->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->status->destroy($id);
    }
}
