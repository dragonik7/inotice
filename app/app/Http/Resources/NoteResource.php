<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class NoteResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text,
            'photos' => $this->photos,
            'user_id' => $this->user_id,
            'tag_id' => $this->tag_id
        ];
    }
}
