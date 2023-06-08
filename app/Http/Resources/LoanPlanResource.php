<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanPlanResource extends JsonResource
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
            'per_installment' => $this->per_installment.' %',
            'min_amount' => apiConvertedAmount($this->min_amount),
            'max_amount' => apiConvertedAmount($this->max_amount),
            'installment_interval' => $this->installment_interval.' Days',
            'total_installment' => $this->total_installment,
        ];
    }
}
