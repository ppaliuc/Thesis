<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OtherBankResource extends JsonResource
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
            'title' => $this->title,
            'min_amount' => apiConvertedAmount($this->min_limit),
            'max_amount' => apiConvertedAmount($this->max_limit),
            'daily_amount_limit' => apiConvertedAmount($this->daily_maximum_limit),
            'monthly_amount_limit' => apiConvertedAmount($this->daily_maximum_limit),
            'daily_transaction_limit' => $this->daily_total_transaction,
            'monthly_transaction_limit' => $this->daily_total_transaction,
            'dynamic_fields' => $this->dynamicFields($this->required_information),
        ];
    }

    public function dynamicFields($data){
        return json_decode($data,true);
    }
}
