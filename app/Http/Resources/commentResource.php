<?php

namespace App\Http\Resources;

use App\Models\RateBook;
use Illuminate\Http\Resources\Json\JsonResource;

class commentResource extends JsonResource
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
             'created_at'=>$this->created_at,
            'name' => $this->name,
            'comment_text' => $this->comment_text,
            'user_id' => $this->user_id,


        ];
    }
}
