<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DpsResource extends JsonResource
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
            'transaction_no' => $this->transaction_no,
            'plan_title' => $this->plan->title,
            'deposit_amount' => apiConvertedAmount($this->deposit_amount),
            'per_installment' => apiConvertedAmount($this->per_installment),
            'matured_amount' => apiConvertedAmount($this->matured_amount),
            'total_installment' => $this->total_installment,
            'given_installment' => $this->given_installment,
            'next_installment' => $this->next_installment ?  $this->next_installment->toDateString() : '--',
            'status' => $this->currentStatus($this->status),
            'logs' => route('api.user.dps.logs',$this->id),
        ];
    }

    public function currentStatus($status){
        if($status == 1){
            return 'running';
        }else{
            return 'matured';
        }
    }
}
