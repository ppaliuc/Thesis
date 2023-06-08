<?php

namespace App\Http\Resources;

use App\Models\Generalsetting;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $gs = Generalsetting::first();

        return [
            'id' => $this->id,
            'currency_id' => $this->currency_id,
            'account_number' => $this->account_number,
            'full_name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'fax' => $this->fax,
            'propic' => $this->photo ? url('/') . '/assets/images/' . $this->photo : url('/') . '/assets/images/'.$gs->user_image,
            'zip_code' => $this->zip,
            'city' => $this->city,
            'country' => $this->country,
            'address' => $this->address,
            'balance' => apiConvertedAmount($this->balance),
            'email_verified' => $this->email_verified,
            'affilate_code' => $this->affilate_code,
            'affilate_link' => url('/').'/?reff='.$this->affilate_code,
            'ban' => $this->is_banned,
            'kyc_status' => $this->kyc_status,
            'kyc_info' => $this->kyc_info,
            'twofa' => $this->twofa,
            'setup_key' => $this->go,
            'otp_submit' => $this->otp_submit,
        ];
    }
}
