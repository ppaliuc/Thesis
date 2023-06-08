<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
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
            'transaction_no' => $this->transaction_no,
            'plan_title' => $this->plan->title,
            'loan_amount' => apiConvertedAmount($this->loan_amount),
            'per_installment_amount' => apiConvertedAmount($this->per_installment_amount),
            'total_installment' => $this->total_installment,
            'given_installment' => $this->given_installment,
            'next_installment' =>  $this->next_installment ?  $this->next_installment->toDateString() : '--',
            'status' => $this->currentStatus($this->status),
            'logs' => route('api.user.loan.logs',$this->id),
        ];
    }

    public function currentStatus($status){
        if($status == 0){
            return 'pending';
        }elseif($status == 1){
            return 'running';
        }elseif($status == 3){
            return 'paid';
        }else{
            return 'rejected';
        }
    }
}
