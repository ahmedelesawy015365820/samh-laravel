<?php

namespace App\Repositery\Room;

use App\Http\Resources\Room\RoomDropdownResource;
use App\Http\Resources\Room\RoomResource;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomRepositry implements RoomInterface
{

    public function getAll($request)
    {
        $models = Room::with(['status:id,name','roomType:id,name'])
            ->when($request->search,function ($q) use($request){
                $q->orWhere('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
            });

        if ($request->per_page) {
            return responseJson(200, 'success', RoomResource::collection($models->paginate($request->per_page)), getPaginates($models->paginate($request->per_page)));
        } else {
            return responseJson(200, 'success', RoomResource::collection($models->get()),null);
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();

            $model = Room::create($request);

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

            $model = Room::find($id);
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

            $model = Room::find($id);
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
        $models = Room::select('id','name','code')->get();

        return responseJson(200, 'success', RoomDropdownResource::collection($models),null);
    }
}
