<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'user_current_plan' => $this->id == auth()->user()->bank_plan_id ? 'YES':'NO',
            'plan_expire_date' => $this->id == auth()->user()->bank_plan_id ? auth()->user()->plan_end_date->toDateString() : 'NULL',
            'title' => $this->title,
            'amount' => apiConvertedAmount($this->amount),
            'auth_user_id' => auth()->id(),
            'attribute' => $this->listOfAttributes($this->attribute),
            'maximum_daily_send' => apiConvertedAmount($this->daily_send),
            'maximum_monthly_send' => apiConvertedAmount($this->monthly_send),
            'maximum_daily_receive' => apiConvertedAmount($this->daily_receive),
            'maximum_monthly_receive' => apiConvertedAmount($this->monthly_receive),
            'maximum_daily_withdraw' => apiConvertedAmount($this->daily_withdraw),
            'maximum_monthly_withdraw' => apiConvertedAmount($this->monthly_withdraw),
            'maximum_loan_amount' => apiConvertedAmount($this->loan_amount),
            'end_days' => $this->days.' Days',
            'get_started' => route('api.user.subscription.plan',[$this->id,auth()->id()]),
        ];
    }

    public function listOfAttributes($data){
        $attribute = [];
        if ($data){
            foreach (json_decode($data,true) as $key=>$value){
                $attribute[$key] = $value;
            }
        }

        return $attribute;
    }
}
