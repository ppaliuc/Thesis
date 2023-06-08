<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralCommissionResource extends JsonResource
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
            'id'     => $this->id,
            'date'   => $this->created_at->toDateString(),
            'type'   => $this->type,
            'from'   => $this->userName($this->from_user_id),
            'amount' => apiConvertedAmount($this->amount),
        ];
    }

    public function userName($id){
        $user = User::whereId($id)->first();
        if($user){
            return $user->name;
        }
        return ' ';
    }
}
