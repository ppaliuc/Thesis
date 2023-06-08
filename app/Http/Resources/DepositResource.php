<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepositResource extends JsonResource
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
            'id'            => $this->id,
            'deposit_number'=> $this->deposit_number,
            'deposit_date'  => date('d M Y',strtotime($this->created_at)),
            'method'        => $this->method,
            'user_email'    => $this->user->email,
            'amount'        => apiConvertedAmount($this->amount),
            'status'        => $this->status == 'pending' ? 'Pending' : "Completed",
            $this->mergeWhen(request()->path() == 'api/user/deposit',[
                'pay_url'   => route('api.user.deposit.confirm',[$this->id,auth()->id()]),
            ])
        ];
    }
}
