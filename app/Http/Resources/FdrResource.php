<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FdrResource extends JsonResource
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
            'fdr_amount' => apiConvertedAmount($this->amount),
            'profit_rate' => $this->interest_rate.'%',
            'profit_type' => $this->profit_type,
            'profit_amount' => apiConvertedAmount($this->profit_amount),
            'next_profit_time' => $this->profit_type == 'partial' ? $this->nextProfitTime($this->next_profit_time) : 'Profit will get after locked period',
            'status' => $this->currentStatus($this->status),
        ];
    }

    public function nextProfitTime($data){
        if($data != NULL){
            return $data->toDateString();
        }
        return NULL;
    }

    public function currentStatus($status){
        if($status == 1){
            return 'running';
        }else{
            return 'closed';
        }
    }
}
