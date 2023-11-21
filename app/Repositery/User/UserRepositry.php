<?php


namespace App\Repositery\User;


use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserRepositry implements UserInterface
{

    public function getAll($request)
    {
        $models = User::with('roles:id')->when($request->search,function ($q) use($request){
            $q->orWhere('name', 'like', '%' . $request->search . '%');
        });

        if ($request->per_page) {
            return responseJson(200, 'success', UserResource::collection($models->paginate($request->per_page)), getPaginates($models->paginate($request->per_page)));
        } else {
            return responseJson(200, 'success', UserResource::collection($models->get()),null);
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();

            $request['show_password'] = $request['password'];
            $model = User::create(Arr::except($request, 'role_id'));
            $model->assignRole([$request['role_id']]);

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

            $model = User::find($id);
            if (!$model) {
                return responseJson(404, 'not found');
            }

            $request['show_password'] = $request['password'];
            $model->update(Arr::except($request, 'role_id'));

            if($request['role_id']){
                DB::table('model_has_roles')->where('model_id',$model->id)->delete();
                $model->assignRole([$request['role_id']]);
            }

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

            $model = User::find($id);
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
        $models = User::select('id','name')->get();

        return responseJson(200, 'success', $models,null);

    }
}
