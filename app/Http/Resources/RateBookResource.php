<?php

namespace App\Http\Resources;

use App\Models\RateBook;
use Illuminate\Http\Resources\Json\JsonResource;

class RateBookResource extends JsonResource
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
            'id'=>$this->id,
            'user' => new UserResource($this->user()->first()),
            'book' => new BookResource($this->book()->first()),
            'value' => $this->value,
            
        ];
    }
}
