<?php

namespace App\Http\Resources;

use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferLogResource extends JsonResource
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
            'date' => $this->created_at->toFormattedDateString(),
            'transaction_no' => $this->transaction_no,
            'user_id' => $this->user_id,
            'receiver_id' => $this->receiver_id,
            $this->mergeWhen($this->receiver_id,[
                'account_no' => $this->getUser($this->receiver_id) != NULL ? $this->getUser($this->receiver_id)->account_number : NULL,
                'account_name' => $this->getUser($this->receiver_id) != NULL ? $this->getUser($this->receiver_id)->name : NULL,
            ]),
            $this->mergeWhen(!$this->receiver_id,[
                'account_no' => $this->getBeneficiary($this->beneficiary_id) != NULL ? $this->getBeneficiary($this->beneficiary_id)->account_number : NULL,
                'account_name' => $this->getBeneficiary($this->beneficiary_id) != NULL ? $this->getBeneficiary($this->beneficiary_id)->account_name : NULL,
            ]),
            'type' => $this->type,
            'amount' => apiConvertedAmount($this->amount),
            'status' => $this->currentStatus($this->status),
        ];
    }

    public function getUser($id){
        return $receiver = User::whereId($id)->first();
    }

    public function getBeneficiary($id){
        return $beneficiary = Beneficiary::whereId($id)->first();
    }

    public function currentStatus($status){
        if($status == 0){
            return 'Pending';
        }elseif($status == 1){
            return 'Completed';
        }else{
            return 'Rejected';
        }
    }
}
