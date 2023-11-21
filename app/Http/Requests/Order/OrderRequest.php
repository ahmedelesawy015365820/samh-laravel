<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'agree' => 'required|in:1,2,3',
            "room_id" => "required|exists:rooms,id",
            "user_id" => "required|exists:users,id",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ];
    }
}
