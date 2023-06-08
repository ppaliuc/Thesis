<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DpsPlanResource extends JsonResource
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
            'interest_rate' => $this->interest_rate,
            'per_installment' => apiConvertedAmount($this->per_installment),
            'total_deposit' => apiConvertedAmount($this->final_amount),
            'after_matured' => apiConvertedAmount($this->final_amount + $this->user_profit),
            'installment_interval' => $this->installment_interval.' Days',
            'total_installment' => $this->total_installment,
            $this->mergeWhen(request()->path() == 'api/user/dps-plans',[
                'apply_url'   => route('api.user.dps.apply',$this->id),
            ])
        ];
    }
}
