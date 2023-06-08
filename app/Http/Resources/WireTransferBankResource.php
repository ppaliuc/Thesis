<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WireTransferBankResource extends JsonResource
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
            'swift_code' => $this->swift_code,
            'currency' => $this->currency->name,
            'routing_number' => $this->routing_number,
            'country' => $this->country->name,
        ];
    }
}
