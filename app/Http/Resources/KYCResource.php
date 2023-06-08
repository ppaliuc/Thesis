<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KYCResource extends JsonResource
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
            'type' => $this->type($this->type),
            'name' => $this->name,
            'required' => $this->required == 1 ? 'true' : '',
        ];
    }

    public function type($type){
        if($type == 1){
           return 'text';
        }elseif($type == 2){
            return 'file';
        }else{
            return 'textarea';
        }
    }
}
