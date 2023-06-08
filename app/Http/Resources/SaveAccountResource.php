<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SaveAccountResource extends JsonResource
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
            'name' => $this->getUser($this->receiver_id)->name,
            'acc_no' => $this->getUser($this->receiver_id)->account_number,
            'photo' => asset('asset/images/'.$this->getUser($this->receiver_id)->photo),
            'save_account_data' => route('api.save.user.info',$this->getUser($this->receiver_id)->account_number),
        ];
    }

    public function getUser($id){
        return User::findOrFail($id);
    }
}
