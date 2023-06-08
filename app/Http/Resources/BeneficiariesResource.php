<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiariesResource extends JsonResource
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
            'bank_name' => $this->bank->title,
            'account_number' => $this->account_number,
            'account_name' => $this->account_name,
            'nick_name' => ucfirst($this->nick_name),
            $this->mergeWhen(!$request->id,[
                'details_url' => route('api.user.beneficiary.show',$this->id),
            ]),
            $this->mergeWhen($request->id,[
                'details' => $this->details != NULL ? $this->beneficiaryDetails($this->details) : NULL,
            ]),
            $this->mergeWhen(request()->path() == 'api/user/other-bank-transfer',[
                'send_money_url' => route('api.user.other.bank.transfer',$this->id),
            ]),

        ];
    }

    public function beneficiaryDetails($data){
        $details = [];
        foreach(json_decode($data,true) as $key=>$value){
            if($value[1] == 'file'){
                $details[$key] = asset('assets/images/'.$value[0]);
            }else{
                $details[$key] = $value[0];
            }
        }

        return $details;
    }
}
