<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => "required|string|max:100|unique:rooms,name," . ($this->method() == 'PUT' ?  $this->id : ""),
            'code' => "required|string|max:20|unique:rooms,code," . ($this->method() == 'PUT' ?  "$this->id" : ""),
            'description' => "nullable|string|max:1000",
            'price' => "required|min:0|max:1000000|regex:/^\d+(\.\d{1,2})?$/",
            "status_id" => "required|exists:statuses,id",
            "room_type_id" => "required|exists:room_types,id"
        ];
    }
}
