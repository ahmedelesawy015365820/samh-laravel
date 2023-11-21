<?php

namespace App\Repositery\RoomType;

use App\Http\Resources\RoomType\RoomTypeResource;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;

class RoomTypeRepositry implements RoomTypeInterface
{

    public function getAll($request)
    {
        $models = RoomType::when($request->search,function ($q) use($request){
            $q->orWhere('name', 'like', '%' . $request->search . '%');
        });

        if ($request->per_page) {
            return responseJson(200, 'success', RoomTypeResource::collection($models->paginate($request->per_page)), getPaginates($models->paginate($request->per_page)));
        } else {
            return responseJson(200, 'success', RoomTypeResource::collection($models->get()),null);
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();

            $model = RoomType::create($request);

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

            $model = RoomType::find($id);
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

            $model = RoomType::find($id);
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
