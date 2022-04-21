<?php

namespace App\Http\Resources;

use App\Models\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
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
        'name'=>$this->name,
        'email'=>$this->email,
        'subs' => Subscriber::query()->where('user_id', '=', $this->id)->count()
        ];
    }
}
