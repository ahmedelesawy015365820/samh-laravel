<?php

namespace App\Repositery\Role;

interface RoleInterface {

    public function getAll($request);

    public function create($request);

    public function update($request, $id);

    public function destroy($id);

    public function getDropdown();

    public function getPermissionDropdown();

}
