<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'message'=>$this->data['message'],
            'created_at'=>$this->created_at->diffForHumans(),
            'read_at'=>$this->read_at,
        ];
    }
}
