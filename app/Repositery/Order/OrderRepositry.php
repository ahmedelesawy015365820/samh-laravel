<?php

namespace App\Repositery\Order;

use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class OrderRepositry implements OrderInterface
{

    public function getAll($request)
    {
        $models = Order::with(['room:id,name','user:id,name'])->when($request->user_id,function ($query) use($request){
            $query->whereUserId($request->user_id);
        });

        if ($request->per_page) {
            return responseJson(200, 'success', OrderResource::collection($models->paginate($request->per_page)), getPaginates($models->paginate($request->per_page)));
        } else {
            return responseJson(200, 'success', OrderResource::collection($models->get()),null);
        }
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();

            $model = Order::create($request);

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

            $model = Order::find($id);
            if (!$model) {
                return responseJson(404, 'not found');
            }

            $model->update($request);

            if ($request['agree'] == 1){
                Room::find($request['room_id'])->update(['status_id'=> 2]);
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

            $model = Order::find($id);
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
