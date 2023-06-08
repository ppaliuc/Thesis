<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'message' => $this->message,
            'user_admin' => $this->user_id == 0 ? 'admin' : 'user',
            'user_id' => $this->user_id != 0 ? $this->user_id : 'NULL',
            'name' => $this->getUser($this->user_id)->name,
            'photo' => asset('assets/images/'.$this->getUser($this->user_id)->photo),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }

    public function getUser($id){
        if($id != 0){
            return User::findOrFail($id);
        }else{
            return Admin::first();
        }
    }
}
