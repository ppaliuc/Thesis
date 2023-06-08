<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WireTransferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'date' => $this->created_at->toFormattedDateString(),
            'bank_name' => $this->bank->title,
            'swift_code' => $this->swift_code,
            'currency' => $this->currency,
            'routing_number' => $this->routing_number,
            'country' => $this->country,
            'account_name' => $this->account_holder_name,
            'account_number' => $this->account_number,
            'amount' => apiConvertedAmount($this->amount),
            'status' => $this->currentStatus($this->status),
            'details' => route('api.user.wire.transfer',$this->id),
        ];
    }

    public function currentStatus($status){
        if($status == 0){
            return 'pending';
        }elseif($status == 1){
            return 'completed';
        }else{
            return 'rejected';
        }
    }
}
