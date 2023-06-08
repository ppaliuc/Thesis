<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FdrPlanResource extends JsonResource
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
            'min_amount' => apiConvertedAmount($this->min_amount),
            'max_amount' => apiConvertedAmount($this->max_amount),
            'interval_type' => $this->interval_type,
            'locked_in_period' => $this->matured_days,
            'get_profit_every' => $this->interest_interval != NULL ? $this->interest_interval : 'N/A',
            $this->mergeWhen(request()->path() == 'api/user/fdr-plans',[
                'apply_url'   => route('api.user.dps.apply',$this->id),
            ])
        ];
    }
}
