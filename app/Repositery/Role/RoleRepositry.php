<?php

namespace App\Repositery\Role;

use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Role\RoleDropdownResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepositry implements RoleInterface
{

    public function getAll($request)
    {
        $models = Role::with('permissions:id')->when($request->search,function ($q) use($request){
            $q->orWhere('name', 'like', '%' . $request->search . '%');
        });

        if ($request->per_page) {
            return responseJson(200, 'success', RoleResource::collection($models->paginate($request->per_page)), getPaginates($models->paginate($request->per_page)));
        } else {
            return responseJson(200, 'success', RoleResource::collection($models->get()),null);
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();

            $model = Role::create(Arr::except($request, 'permissions'));
            $model->permissions()->sync($request['permissions']);

            DB::commit();
            return responseJson(200, 'success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return responseJson(500, $ex);
        }
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $model = Role::find($id);
            if (!$model) {
                return responseJson(404, 'not found');
            }

            $model->update(Arr::except($request, 'permissions'));
            $model->permissions()->sync($request['permissions']);

            DB::commit();
            return responseJson(200, 'success');

        } catch (\Exception $ex) {
            DB::rollBack();
            return responseJson(500, $ex);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $model = Role::find($id);
            if (!$model) {
                return responseJson(404, 'not found');
            }
            $model->delete();

            DB::commit();
            return responseJson(200, 'deleted');

        } catch (\Exception $ex) {
            DB::rollBack();
            return responseJson(500, $ex);
        }
    }

    public function getDropdown()
    {
        $models = Role::get();

        return responseJson(200, 'success', RoleDropdownResource::collection($models),null);
    }

    public function getPermissionDropdown()
    {
        $models = Permission::get();

        return responseJson(200, 'success', PermissionResource::collection($models),null);
    }
}
