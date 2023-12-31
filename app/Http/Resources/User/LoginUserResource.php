<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Permission\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'status' => $this->status,
            'permissions' => PermissionResource::collection($this->getAllPermissions())
        ];
    }
}
