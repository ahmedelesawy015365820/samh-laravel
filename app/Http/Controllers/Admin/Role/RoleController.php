<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Repositery\Role\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    function __construct(RoleInterface $role){
        $this->role = $role;
    }

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function get(Request $request)
    {
        return $this->role->getAll($request);
    }

    public function create(RoleRequest $request)
    {
        return $this->role->create($request->validated());
    }


    public function update(RoleRequest $request, $id)
    {
        return $this->role->update($request->validated(), $id);
    }

    public function delete($id)
    {
        return $this->role->destroy($id);
    }

    public function getDropdown()
    {
        return $this->role->getDropdown();
    }

    public function getPermissionDropdown()
    {
        return$this->role->getPermissionDropdown();
    }
}
