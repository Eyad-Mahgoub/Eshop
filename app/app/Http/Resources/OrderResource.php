<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'userdetail_id' => $this->userdetail_id,
            'total_price' => $this->totalprice,
            'tracking_no' => $this->tracking_no,
            'items' => new OrderItemCollection($this->orders),
        ];
    }
}
