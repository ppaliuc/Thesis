<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'id'      => $this->id,
            'txnid'   => $this->txnid,
            'user_id' => $this->user_id,
            'email'   => $this->email,
            'type'    => $this->type,
            'amount'  => apiConvertedAmount($this->amount),
            'profit'  => $this->profit,
            'date'    => date('d M Y',strtotime($this->created_at))
        ];
    }


}
