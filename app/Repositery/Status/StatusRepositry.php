<?php

namespace App\Repositery\Status;

use App\Http\Resources\Status\StatusResource;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusRepositry implements StatusInterface
{

    public function getAll($request)
    {
        $models = Status::when($request->search,function ($q) use($request){
            $q->orWhere('name', 'like', '%' . $request->search . '%');
        });

        if ($request->per_page) {
            return responseJson(200, 'success', StatusResource::collection($models->paginate($request->per_page)), getPaginates($models->paginate($request->per_page)));
        } else {
            return responseJson(200, 'success', StatusResource::collection($models->get()),null);
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();

            $model = Status::create($request);

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

            $model = Status::find($id);
            if (!$model) {
                return responseJson(404, 'not found');
            }

            $model->update($request);

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

            $model = Status::find($id);
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
}
