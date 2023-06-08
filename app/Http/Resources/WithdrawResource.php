<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawResource extends JsonResource
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
            'date' => date('d-M-Y',strtotime($this->created_at)),
            'method' => $this->method,
            'amount' => apiConvertedAmount($this->amount),
            'fee' => $this->fee,
            'status' => $this->currentStatus($this->status),
            $this->mergeWhen(!$request->id,[
                'details' => route('api.user.withdraw.details',$this->id),
            ]),
        ];
    }

    public function currentStatus($status){
        if($status == 'pending'){
            return 'pending';
        }elseif($status == 'completed'){
            return 'completed';
        }else{
            return 'rejected';
        }
    }
}
