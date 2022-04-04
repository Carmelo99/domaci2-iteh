<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'video';
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->resource->id,
            'name'=>$this->resource->name,
            'length'=>$this->resource->length,
            'resolution'=>$this->resource->resolution,
            'owner'=>$this->resource->owner,
            'trainer'=>new UserResource($this->resource->user),


        ];
    }
}
