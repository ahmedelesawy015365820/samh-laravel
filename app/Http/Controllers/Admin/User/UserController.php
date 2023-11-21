<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Repositery\User\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(UserInterface $user){
        $this->user = $user;
    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function get(Request $request)
    {
        return $this->user->getAll($request);
    }

    public function create(UserRequest $request)
    {
        return $this->user->create($request->validated());
    }

    public function update(UserRequest $request, $id)
    {
        return $this->user->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->user->destroy($id);
    }

    public function getDropdown(){
        return $this->user->getDropdown();
    }
}
